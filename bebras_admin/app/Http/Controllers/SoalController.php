<?php
namespace App\Http\Controllers;

use App\Models\MenuSoal;
use App\Models\MenuSoalItem;
use App\Models\SoalChallenge;
use App\Models\SoalChallengeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SoalController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null)
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Soal Bebras', 'url' => route('soal_bebras.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    // =========================================
    //  MENU SOAL (index / create / edit / etc)
    // =========================================

    public function index(Request $request)
    {
        $breadcrumbs = $this->breadCrumbs('Halaman Soal Bebras');

        if ($request->ajax()) {
            $data = MenuSoal::with('parent')
                ->orderBy('urutan', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('parent', function ($row) {
                    return $row->parent ? $row->parent->nama_menu : '-';
                })
                ->addColumn('judul', function ($row) {
                    return $row->judul ?? '-';
                })
                ->addColumn('body', function ($row) {
                    return $row->body ? \Str::limit(strip_tags($row->body), 50) : '-';
                })
                ->make(true);
        }

        return view('soal.soal_index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = $this->breadcrumbs('Tambah Halaman Soal Bebras');
        $menuList    = MenuSoal::orderBy('urutan', 'asc')->get();

        return view('soal.form_soal', compact('breadcrumbs', 'menuList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menu_soal,id',
            'nama_menu' => 'required|string|max:255',
            'slug'      => 'required|string|max:255|unique:menu_soal,slug',
            'judul'     => 'nullable|string|max:255',
            'body'      => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png',
            'urutan'    => 'nullable|integer',
        ]);

        DB::beginTransaction();

        try {
            $path = null;

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('soal-bebras', 'public');
            }

            MenuSoal::create([
                'parent_id' => $validated['parent_id'] ?? null,
                'nama_menu' => $validated['nama_menu'],
                'slug'      => $validated['slug'],
                'judul'     => $validated['judul'] ?? null,
                'body'      => $validated['body'] ?? null,
                'gambar'    => $path,
                'urutan'    => $validated['urutan'] ?? 0,
            ]);

            DB::commit();

            return redirect()
                ->route('soal_bebras.index')
                ->with('success', 'Data berhasil ditambahkan');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $breadcrumbs = $this->breadCrumbs('Edit Halaman Soal Bebras');
        $data        = MenuSoal::with(['parent', 'items', 'challenges.options'])->findOrFail($id);
        $menuList    = MenuSoal::where('id', '!=', $id)
            ->whereNull('parent_id')
            ->orderBy('urutan', 'desc')->get();
        return view('soal.form_soal', compact('data', 'breadcrumbs', 'menuList'));
    }

    public function update(Request $request, $id)
    {
        $data = MenuSoal::findOrFail($id);

        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menu_soal,id',
            'nama_menu' => 'required|string|max:255',
            'slug'      => 'required|string|max:255|unique:menu_soal,slug,' . $id,
            'judul'     => 'nullable|string|max:255',
            'body'      => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'urutan'    => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('gambar')) {
                if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }

                $validated['gambar'] = $request->file('gambar')->store('soal-bebras', 'public');
            } else {
                unset($validated['gambar']);
            }

            $data->update($validated);

            DB::commit();

            return redirect()->route('soal_bebras.edit', $id)->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {
        $breadcrumbs = $this->breadCrumbs('Detail Soal Bebras');

        $menu = MenuSoal::with('parent')->findOrFail($id);

        return view('soal.detail_soal', compact('breadcrumbs', 'menu'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $data = MenuSoal::findOrFail($id);
            if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->delete();
            DB::commit();
            return redirect()
                ->route('soal_bebras.index')
                ->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================
    //  MENU SOAL ITEMS (konsep & kriteria)
    // =========================================

    public function getItems($id)
    {
        $menu  = MenuSoal::findOrFail($id);
        $items = $menu->items()->orderBy('tipe')->orderBy('urutan')->get();
        return response()->json($items);
    }

    public function storeItem(Request $request, $id)
    {
        $menu = MenuSoal::findOrFail($id);
        $validated = $request->validate([
            'tipe'   => 'required|in:konsep,kriteria',
            'judul'  => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $item = $menu->items()->create([
            'tipe'   => $validated['tipe'],
            'judul'  => $validated['judul'],
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return response()->json(['success' => true, 'item' => $item]);
    }

    public function updateItem(Request $request, $itemId)
    {
        $item = MenuSoalItem::findOrFail($itemId);
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);
        $item->update($validated);
        return response()->json(['success' => true, 'item' => $item]);
    }

    public function destroyItem($itemId)
    {
        MenuSoalItem::findOrFail($itemId)->delete();
        return response()->json(['success' => true]);
    }

    // =========================================
    //  SOAL CHALLENGE
    // =========================================

    public function createChallenge($id)
    {
        $breadcrumbs = $this->breadCrumbs('Tambah Challenge');
        $menu        = MenuSoal::findOrFail($id);
        return view('soal.form_challenge', compact('breadcrumbs', 'menu'));
    }

    public function storeChallenge(Request $request, $id)
    {
        $menu = MenuSoal::findOrFail($id);

        $validated = $request->validate([
            'kategori_umur'   => 'nullable|string|max:100',
            'tingkat'         => 'required|in:SD,SMP,SMA',
            'kesulitan'       => 'required|in:Mudah,Menengah,Sulit',
            'kategori_materi' => 'required|string|max:255',
            'judul'           => 'required|string|max:255',
            'gambar_soal_1'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'deskripsi_soal'  => 'nullable|string',
            'gambar_soal_2'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'solusi'          => 'nullable|string',
            'ini_informatika' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar_soal_1')) {
                $validated['gambar_soal_1'] = $request->file('gambar_soal_1')->store('soal-challenges', 'public');
            }
            if ($request->hasFile('gambar_soal_2')) {
                $validated['gambar_soal_2'] = $request->file('gambar_soal_2')->store('soal-challenges', 'public');
            }

            $challenge = $menu->challenges()->create($validated);
            DB::commit();

            return redirect()
                ->route('soal_bebras.edit', $id)
                ->with('success', 'Challenge berhasil disimpan. Sekarang tambahkan pilihan jawaban.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function editChallenge($cid)
    {
        $challenge   = SoalChallenge::with(['menuSoal', 'options'])->findOrFail($cid);
        $menu        = $challenge->menuSoal;
        $breadcrumbs = $this->breadCrumbs('Edit Challenge');
        return view('soal.form_challenge', compact('breadcrumbs', 'menu', 'challenge'));
    }

    public function updateChallenge(Request $request, $cid)
    {
        $challenge = SoalChallenge::findOrFail($cid);

        $validated = $request->validate([
            'kategori_umur'   => 'nullable|string|max:100',
            'tingkat'         => 'required|in:SD,SMP,SMA',
            'kesulitan'       => 'required|in:Mudah,Menengah,Sulit',
            'kategori_materi' => 'required|string|max:255',
            'judul'           => 'required|string|max:255',
            'gambar_soal_1'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'deskripsi_soal'  => 'nullable|string',
            'gambar_soal_2'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'solusi'          => 'nullable|string',
            'ini_informatika' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            foreach (['gambar_soal_1', 'gambar_soal_2'] as $imgField) {
                if ($request->hasFile($imgField)) {
                    if ($challenge->$imgField && Storage::disk('public')->exists($challenge->$imgField)) {
                        Storage::disk('public')->delete($challenge->$imgField);
                    }
                    $validated[$imgField] = $request->file($imgField)->store('soal-challenges', 'public');
                } else {
                    unset($validated[$imgField]);
                }
            }

            $challenge->update($validated);
            DB::commit();

            return redirect()
                ->route('soal_bebras.edit', $challenge->menu_soal_id)
                ->with('success', 'Challenge berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyChallenge($cid)
    {
        DB::beginTransaction();
        try {
            $challenge = SoalChallenge::with('options')->findOrFail($cid);
            $menuId    = $challenge->menu_soal_id;

            foreach (['gambar_soal_1', 'gambar_soal_2'] as $imgField) {
                if ($challenge->$imgField && Storage::disk('public')->exists($challenge->$imgField)) {
                    Storage::disk('public')->delete($challenge->$imgField);
                }
            }
            foreach ($challenge->options as $opt) {
                if ($opt->gambar && Storage::disk('public')->exists($opt->gambar)) {
                    Storage::disk('public')->delete($opt->gambar);
                }
            }
            $challenge->delete();
            DB::commit();

            return redirect()->route('soal_bebras.edit', $menuId)->with('success', 'Challenge berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================
    //  CHALLENGE OPTIONS (A/B/C/D)
    // =========================================

    public function storeOption(Request $request, $cid)
    {
        $challenge = SoalChallenge::findOrFail($cid);

        $validated = $request->validate([
            'label'  => 'required|string|max:10',
            'teks'   => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'urutan' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('soal-options', 'public');
            }

            $option = $challenge->options()->create([
                'label'  => $validated['label'],
                'teks'   => $validated['teks'] ?? null,
                'gambar' => $validated['gambar'] ?? null,
                'urutan' => $validated['urutan'] ?? 0,
            ]);

            DB::commit();
            return response()->json(['success' => true, 'option' => $option, 'gambar_url' => $option->gambar ? Storage::url($option->gambar) : null]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateOption(Request $request, $oid)
    {
        $option = SoalChallengeOption::findOrFail($oid);

        $validated = $request->validate([
            'label'  => 'required|string|max:10',
            'teks'   => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'urutan' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                if ($option->gambar && Storage::disk('public')->exists($option->gambar)) {
                    Storage::disk('public')->delete($option->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('soal-options', 'public');
            } else {
                unset($validated['gambar']);
            }

            $option->update($validated);
            DB::commit();
            return response()->json(['success' => true, 'option' => $option, 'gambar_url' => $option->gambar ? Storage::url($option->gambar) : null]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroyOption($oid)
    {
        DB::beginTransaction();
        try {
            $option = SoalChallengeOption::findOrFail($oid);
            if ($option->gambar && Storage::disk('public')->exists($option->gambar)) {
                Storage::disk('public')->delete($option->gambar);
            }
            $option->delete();
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

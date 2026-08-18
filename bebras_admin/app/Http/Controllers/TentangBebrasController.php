<?php
namespace App\Http\Controllers;

use App\Models\TentangBebras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TentangBebrasController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null)
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Tentang Bebras', 'url' => route('tentang_bebras.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index()
    {
        $breadcrumbs = $this->breadCrumbs('Halaman Tentang Bebras');

        return view('tentang_bebras.tentang_bebras', compact('breadcrumbs'));
    }

    public function getData()
    {
        $data = TentangBebras::select(['id', 'slug', 'judul', 'gambar', 'urutan', 'konten', 'created_at']);

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('gambar', function ($row) {
                if ($row->gambar) {
                    $gambarUrl = Storage::url($row->gambar);
                    return '<img src="' . $gambarUrl . '" alt="Gambar" width="50" height="50"
                                 style="object-fit:cover;"
                                 onerror="this.onerror=null;this.replaceWith(document.createTextNode(\'-\'))">';
                }
                return '<span class="badge bg-label-secondary">Tidak ada gambar</span>';
            })
            ->addColumn('aksi', function ($row) {
                $editUrl   = route('tentang_bebras.edit', $row->id);
                $deleteUrl = route('tentang_bebras.destroy', $row->id);

                return '
                    <div class="d-flex">
                        <!-- Tombol Detail -->
                        <button class="btn btn-sm btn-icon btn-info me-1 btn-detail"
                                data-id="' . $row->id . '"
                                data-judul="' . e($row->judul) . '">
                            <i class="bx bx-show"></i>
                        </button>

                        <!-- Hidden div untuk konten -->
                        <div id="konten-' . $row->id . '" class="d-none">
                            ' . $row->konten . '
                        </div>

                        <!-- Tombol Edit -->
                        <a href="' . $editUrl . '" class="btn btn-sm btn-icon btn-warning me-1">
                            <i class="bx bx-edit"></i>
                        </a>

                        <!-- Tombol Delete -->
                        <form action="' . $deleteUrl . '" method="POST" class="delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })

            ->rawColumns(['gambar', 'aksi'])
            ->make(true);
    }

    public function create()
    {

        $breadcrumbs = $this->breadcrumbs('Tambah Halaman Tentang Bebras');

        return view('tentang_bebras.form', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug'     => 'required|unique:tentang_bebras,slug',
            'judul'    => 'required|string|max:255',
            'konten'   => $request->template === 'dd_4' ? 'nullable|string' : 'required|string',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'urutan'   => 'required|integer',
            'template' => 'required|in:dd_1,dd_2,dd_3,dd_4,dd_5,dd_6',
        ]);

        if ($request->template === 'dd_4') {
            $validated['konten'] = '';
        }

        if (in_array($request->template, ['dd_4', 'dd_6'])) {
            $validated['gambar'] = null;
        }

        DB::beginTransaction();
        try {
            if (!in_array($request->template, ['dd_4', 'dd_6']) && $request->hasFile('gambar')) {
                $gambarPath          = $request->file('gambar')->store('tentang-bebras', 'public');
                $validated['gambar'] = $gambarPath;
            }

            TentangBebras::create($validated);
            DB::commit();

            return redirect()->route('tentang_bebras.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $breadcrumbs = $this->breadCrumbs('Halaman Tentang Bebras');
        $data        = TentangBebras::findOrFail($id);
        return view('tentang_bebras.form', compact('data', 'breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        $data = TentangBebras::findOrFail($id);

        $validated = $request->validate([
            'slug'     => 'required|unique:tentang_bebras,slug,' . $id,
            'judul'    => 'required|string|max:255',
            'konten'   => $request->template === 'dd_4' ? 'nullable|string' : 'required|string',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'urutan'   => 'required|integer|min:0',
            'template' => 'required|in:dd_1,dd_2,dd_3,dd_4,dd_5,dd_6',
        ]);

        if ($request->template === 'dd_4') {
            $validated['konten'] = '';
        }

        DB::beginTransaction();
        try {
            if (in_array($request->template, ['dd_4', 'dd_6'])) {
                if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }
                $validated['gambar'] = null;
            } elseif ($request->hasFile('gambar')) {
                if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }

                $gambarPath          = $request->file('gambar')->store('tentang-bebras', 'public');
                $validated['gambar'] = $gambarPath;
            } else {
                unset($validated['gambar']);
            }
            if (empty($validated['slug'])) {
                unset($validated['slug']);
            }

            $data->update($validated);

            DB::commit();

            return redirect()->route('tentang_bebras.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $data = TentangBebras::findOrFail($id);
        DB::beginTransaction();

        try {
            if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                Storage::disk('public')->delete($data->gambar);
            }

            $data->delete();
            DB::commit();
            return redirect()->route('tentang_bebras.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['errors' => 'Terjadi kesalahan: ' . $th->getMessage()]);
        }
    }

    public function storeItemChild(Request $request, $tentang_bebras_id)
    {
        $request->validate([
            'tipe'      => 'required|string',
            'icon'      => 'nullable|string',
            'judul'     => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'bg_color'  => 'nullable|string',
            'urutan'    => 'required|integer',
        ]);

        \App\Models\TentangBebrasItem::create([
            'tentang_bebras_id' => $tentang_bebras_id,
            'tipe'              => $request->tipe,
            'icon'              => $request->icon,
            'judul'             => $request->judul,
            'deskripsi'         => $request->deskripsi,
            'bg_color'          => $request->bg_color,
            'urutan'            => $request->urutan,
        ]);

        return back()->with('success', 'Item pendukung berhasil ditambahkan');
    }

    public function updateItemChild(Request $request, $id)
    {
        $request->validate([
            'tipe'      => 'required|string',
            'icon'      => 'nullable|string',
            'judul'     => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'bg_color'  => 'nullable|string',
            'urutan'    => 'required|integer',
        ]);

        $item = \App\Models\TentangBebrasItem::findOrFail($id);
        $item->update([
            'tipe'      => $request->tipe,
            'icon'      => $request->icon,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'bg_color'  => $request->bg_color,
            'urutan'    => $request->urutan,
        ]);

        return back()->with('success', 'Item pendukung berhasil diperbarui');
    }

    public function destroyItemChild($id)
    {
        $item = \App\Models\TentangBebrasItem::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item pendukung berhasil dihapus');
    }
}

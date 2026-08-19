<?php

namespace App\Http\Controllers;

use App\Models\MenuKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class MenuKegiatanController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null): array
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Menu Kegiatan', 'url' => route('menu_kegiatan.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $menus = MenuKegiatan::with('parent')->orderBy('urutan');
            return DataTables::of($menus)
                ->addIndexColumn()
                ->addColumn('parent', fn($row) => $row->parent?->nama_menu ?? '-')
                ->addColumn('actions', function ($row) {
                    $editUrl   = route('menu_kegiatan.edit', $row->id);
                    $deleteUrl = route('menu_kegiatan.destroy', $row->id);
                    return '
                        <div class="d-flex gap-1">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Hapus menu ini?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $breadcrumbs = $this->breadCrumbs('Daftar Menu Kegiatan');
        return view('menu_kegiatan.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = $this->breadCrumbs('Tambah Menu Kegiatan');
        $menuList    = MenuKegiatan::whereNull('parent_id')->orderBy('urutan')->get();
        return view('menu_kegiatan.form', compact('breadcrumbs', 'menuList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menu_kegiatan,id',
            'nama_menu' => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255|unique:menu_kegiatan,slug',
            'judul'     => 'nullable|string|max:255',
            'body'      => 'nullable|string',
            'url'       => 'nullable|url|max:500',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'urutan'    => 'required|integer|min:0',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['nama_menu']);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('menu_kegiatan', 'public');
            }
            MenuKegiatan::create($validated);
            DB::commit();
            return redirect()->route('menu_kegiatan.index')->with('success', 'Menu Kegiatan berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $data        = MenuKegiatan::findOrFail($id);
        $breadcrumbs = $this->breadCrumbs('Edit Menu Kegiatan');
        // Exclude self and own children from parent list
        $menuList    = MenuKegiatan::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('urutan')
            ->get();
        return view('menu_kegiatan.form', compact('breadcrumbs', 'data', 'menuList'));
    }

    public function update(Request $request, $id)
    {
        $data = MenuKegiatan::findOrFail($id);

        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menu_kegiatan,id',
            'nama_menu' => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255|unique:menu_kegiatan,slug,' . $id,
            'judul'     => 'nullable|string|max:255',
            'body'      => 'nullable|string',
            'url'       => 'nullable|url|max:500',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'urutan'    => 'required|integer|min:0',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['nama_menu']);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('menu_kegiatan', 'public');
            } else {
                unset($validated['gambar']);
            }
            $data->update($validated);
            DB::commit();
            return redirect()->route('menu_kegiatan.index')->with('success', 'Menu Kegiatan berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = MenuKegiatan::findOrFail($id);
            if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('menu_kegiatan.index')->with('success', 'Menu Kegiatan berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

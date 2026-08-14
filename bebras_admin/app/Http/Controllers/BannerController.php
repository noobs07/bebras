<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null)
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Banner', 'url' => route('banner.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index()
    {
        $breadcrumbs = $this->breadCrumbs('Daftar Banner');
        return view('banner.index', compact('breadcrumbs'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $banners = Banner::orderBy('urutan', 'asc');
            return DataTables::of($banners)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    if ($row->gambar) {
                        $url = str_starts_with($row->gambar, 'img/')
                            ? asset($row->gambar)
                            : asset('storage/' . $row->gambar);
                        return '<img src="' . $url . '" alt="banner" width="80" height="50"
                                     style="object-fit:cover;border-radius:4px;"
                                     onerror="this.onerror=null;this.replaceWith(document.createTextNode(\'- no img -\'))">';
                    }
                    return '<span class="badge bg-label-secondary">Tidak ada gambar</span>';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl   = route('banner.edit', $row->id);
                    $deleteUrl = route('banner.destroy', $row->id);
                    return '
                        <div class="d-flex gap-1">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-warning">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Hapus banner ini?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['gambar', 'actions'])
                ->make(true);
        }
    }

    public function create()
    {
        $breadcrumbs = $this->breadCrumbs('Tambah Banner');
        return view('banner.form', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'urutan'     => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('banners', 'public');
            }
            Banner::create($validated);
            DB::commit();
            return redirect()->route('banner.index')->with('success', 'Banner berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $breadcrumbs = $this->breadCrumbs('Edit Banner');
        $data = Banner::findOrFail($id);
        return view('banner.form', compact('breadcrumbs', 'data'));
    }

    public function update(Request $request, $id)
    {
        $data = Banner::findOrFail($id);

        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'urutan'     => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('banners', 'public');
            } else {
                unset($validated['gambar']);
            }
            $data->update($validated);
            DB::commit();
            return redirect()->route('banner.index')->with('success', 'Banner berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = Banner::findOrFail($id);
            if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('banner.index')->with('success', 'Banner berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BerandaCmsController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null): array
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Pengaturan Beranda', 'url' => route('beranda.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index()
    {
        $breadcrumbs = $this->breadCrumbs('Pengaturan Beranda');
        $aboutLogo    = Setting::getByKey('home_about_logo', 'img/logo.jpg');
        $aboutContent = Setting::getByKey('home_about_content', '');
        $ctaTitle       = Setting::getByKey('home_cta_title', 'Bebras Indonesia Challenge 2024');
        $ctaDescription = Setting::getByKey('home_cta_description', '');
        $ctaLink        = Setting::getByKey('home_cta_link', '#');

        return view('beranda.index', compact(
            'breadcrumbs',
            'aboutLogo',
            'aboutContent',
            'ctaTitle',
            'ctaDescription',
            'ctaLink'
        ));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $kegiatan = Kegiatan::where('tipe', 'kegiatan_utama')->orderBy('urutan');
            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    if ($row->gambar) {
                        $url = str_starts_with($row->gambar, 'img/')
                            ? asset($row->gambar)
                            : asset('storage/' . $row->gambar);
                        return '<img src="' . $url . '" width="60" height="45"
                                    style="object-fit:cover;border-radius:4px;"
                                    onerror="this.onerror=null;this.replaceWith(document.createTextNode(\'-\'))">';
                    }
                    return '-';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl   = route('beranda.kegiatan.edit', $row->id);
                    $deleteUrl = route('beranda.kegiatan.destroy', $row->id);
                    return '
                        <div class="d-flex gap-1">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Hapus kegiatan beranda ini?\')">
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

    public function updateAbout(Request $request)
    {
        $request->validate([
            'home_about_logo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'home_about_content' => 'nullable|string',
        ]);

        if ($request->hasFile('home_about_logo')) {
            $path = $request->file('home_about_logo')->store('settings', 'public');
            Setting::setByKey('home_about_logo', $path);
        }

        Setting::setByKey('home_about_content', $request->home_about_content ?? '');

        return redirect()->route('beranda.index')->with('success', 'Section Tentang Bebras berhasil diperbarui');
    }

    public function updateCta(Request $request)
    {
        $request->validate([
            'home_cta_title'       => 'required|string|max:255',
            'home_cta_description' => 'nullable|string',
            'home_cta_link'        => 'nullable|string|max:500',
        ]);

        Setting::setByKey('home_cta_title', $request->home_cta_title);
        Setting::setByKey('home_cta_description', $request->home_cta_description ?? '');
        Setting::setByKey('home_cta_link', $request->home_cta_link ?? '#');

        return redirect()->route('beranda.index')->with('success', 'Section CTA Beranda berhasil diperbarui');
    }

    public function kegiatanCreate()
    {
        $breadcrumbs = $this->breadCrumbs('Tambah Kegiatan Beranda');
        return view('beranda.kegiatan_form', compact('breadcrumbs'));
    }

    public function kegiatanStore(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'urutan'    => 'required|integer|min:0',
        ]);

        $validated['tipe'] = 'kegiatan_utama';
        $validated['menu_kegiatan_id'] = null;

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
            }
            Kegiatan::create($validated);
            DB::commit();
            return redirect()->route('beranda.index')->with('success', 'Kegiatan Beranda berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function kegiatanEdit($id)
    {
        $breadcrumbs = $this->breadCrumbs('Edit Kegiatan Beranda');
        $data        = Kegiatan::findOrFail($id);
        return view('beranda.kegiatan_form', compact('breadcrumbs', 'data'));
    }

    public function kegiatanUpdate(Request $request, $id)
    {
        $data = Kegiatan::findOrFail($id);

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'urutan'    => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
            }
            $data->update($validated);
            DB::commit();
            return redirect()->route('beranda.index')->with('success', 'Kegiatan Beranda berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function kegiatanDestroy($id)
    {
        DB::beginTransaction();
        try {
            $data = Kegiatan::findOrFail($id);
            if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('beranda.index')->with('success', 'Kegiatan Beranda berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

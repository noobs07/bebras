<?php

namespace App\Http\Controllers;

use App\Models\SoalBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SoalBookController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null)
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Soal Bebras', 'url' => route('soal_bebras.index')],
            ['label' => 'Sumber Buku', 'url' => route('soal_book.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index(Request $request)
    {
        $breadcrumbs = $this->breadCrumbs('Daftar Buku');

        if ($request->ajax()) {
            $data = SoalBook::orderBy('kategori')->orderBy('urutan')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('cover_preview', function ($row) {
                    if ($row->cover_image) {
                        $src = (str_starts_with($row->cover_image, 'img/'))
                            ? asset($row->cover_image)
                            : Storage::url($row->cover_image);
                        return '<img src="' . $src . '" alt="cover" style="width:50px;height:60px;object-fit:cover;border-radius:4px;">';
                    }
                    return '<span class="text-muted">-</span>';
                })
                ->addColumn('kategori_label', function ($row) {
                    $map = [
                        'sikecil'   => '🟣 SiKecil (PAUD/TK)',
                        'siaga'     => '🟢 Siaga (SD/MI)',
                        'penggalang'=> '🟡 Penggalang (SMP/MTs)',
                        'penegak'   => '🔴 Penegak (SMA/SMK)',
                    ];
                    return $map[$row->kategori] ?? $row->kategori;
                })
                ->addColumn('pdf_link_short', function ($row) {
                    return '<a href="' . htmlspecialchars($row->pdf_link) . '" target="_blank" class="btn btn-sm btn-outline-info">Buka PDF</a>';
                })
                ->rawColumns(['cover_preview', 'pdf_link_short'])
                ->make(true);
        }

        return view('soal_book.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = $this->breadCrumbs('Tambah Buku');
        return view('soal_book.form', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'    => 'required|in:sikecil,siaga,penggalang,penegak',
            'judul'       => 'required|string|max:255',
            'pdf_link'    => 'required|string|max:500',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'urutan'      => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('cover_image')) {
                $validated['cover_image'] = $request->file('cover_image')->store('soal-books', 'public');
            }

            SoalBook::create([
                'kategori'    => $validated['kategori'],
                'judul'       => $validated['judul'],
                'pdf_link'    => $validated['pdf_link'],
                'cover_image' => $validated['cover_image'] ?? null,
                'urutan'      => $validated['urutan'] ?? 0,
            ]);

            DB::commit();
            return redirect()->route('soal_book.index')->with('success', 'Buku berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $breadcrumbs = $this->breadCrumbs('Edit Buku');
        $data = SoalBook::findOrFail($id);
        return view('soal_book.form', compact('breadcrumbs', 'data'));
    }

    public function update(Request $request, $id)
    {
        $data = SoalBook::findOrFail($id);

        $validated = $request->validate([
            'kategori'    => 'required|in:sikecil,siaga,penggalang,penegak',
            'judul'       => 'required|string|max:255',
            'pdf_link'    => 'required|string|max:500',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'urutan'      => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('cover_image')) {
                if ($data->cover_image && !str_starts_with($data->cover_image, 'img/') && Storage::disk('public')->exists($data->cover_image)) {
                    Storage::disk('public')->delete($data->cover_image);
                }
                $validated['cover_image'] = $request->file('cover_image')->store('soal-books', 'public');
            } else {
                unset($validated['cover_image']);
            }

            $data->update($validated);

            DB::commit();
            return redirect()->route('soal_book.index')->with('success', 'Buku berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = SoalBook::findOrFail($id);
            if ($data->cover_image && !str_starts_with($data->cover_image, 'img/') && Storage::disk('public')->exists($data->cover_image)) {
                Storage::disk('public')->delete($data->cover_image);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('soal_book.index')->with('success', 'Buku berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

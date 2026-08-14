<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null)
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Pengaturan', 'url' => route('setting.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index()
    {
        $breadcrumbs = $this->breadCrumbs('Daftar Pengaturan');
        return view('setting.index', compact('breadcrumbs'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $settings = Setting::query();
            return DataTables::of($settings)
                ->addIndexColumn()
                ->addColumn('nilai_preview', function ($row) {
                    $stripped = strip_tags($row->nilai ?? '');
                    return \Str::limit($stripped, 80);
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('setting.edit', $row->id);
                    $deleteUrl = route('setting.destroy', $row->id);
                    return '
                        <div class="d-flex gap-1">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Hapus pengaturan ini?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function create()
    {
        $breadcrumbs = $this->breadCrumbs('Tambah Pengaturan');
        return view('setting.form', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key'   => 'required|string|unique:settings,key|max:255',
            'nilai' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            Setting::create([
                'key'   => $request->key,
                'nilai' => $request->nilai,
            ]);
            DB::commit();
            return redirect()->route('setting.index')->with('success', 'Pengaturan berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $breadcrumbs = $this->breadCrumbs('Edit Pengaturan');
        $data = Setting::findOrFail($id);
        return view('setting.form', compact('breadcrumbs', 'data'));
    }

    public function update(Request $request, $id)
    {
        $data = Setting::findOrFail($id);

        $request->validate([
            'key'   => 'required|string|unique:settings,key,' . $id . '|max:255',
            'nilai' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $data->update([
                'key'   => $request->key ?? $data->key,
                'nilai' => $request->nilai,
            ]);
            DB::commit();
            return redirect()->route('setting.index')->with('success', 'Pengaturan berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Setting::findOrFail($id)->delete();
            DB::commit();
            return redirect()->route('setting.index')->with('success', 'Pengaturan berhasil dihapus');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

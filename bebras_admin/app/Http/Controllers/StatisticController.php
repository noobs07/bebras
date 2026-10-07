<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StatisticController extends Controller
{
    private function breadCrumbs($currentLabel, $currentUrl = null): array
    {
        return [
            ['label' => 'Home', 'route' => 'admin.dashboard'],
            ['label' => 'Statistik Bebras', 'url' => route('statistik.index')],
            ['label' => $currentLabel, 'url' => $currentUrl],
        ];
    }

    public function index(Request $request)
    {
        $breadcrumbs = $this->breadCrumbs('Halaman Statistik Bebras');

        return view('statistik.index', compact('breadcrumbs'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $statistics = Statistic::orderBy('year', 'desc');
            return DataTables::of($statistics)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '
                        <div class="d-flex gap-1">
                            <button onclick="editStatistik(' . $row->id . ')" class="btn btn-sm btn-warning" title="Edit"><i class="bx bx-edit"></i> Edit</button>
                            <button onclick="deleteStatistik(' . $row->id . ')" class="btn btn-sm btn-danger" title="Hapus"><i class="bx bx-trash"></i> Hapus</button>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year'       => 'required|integer|min:1000|max:9999',
            'si_kecil'   => 'nullable|integer|min:0',
            'siaga'      => 'nullable|integer|min:0',
            'penggalang' => 'nullable|integer|min:0',
            'penegak'    => 'nullable|integer|min:0',
            'pria'       => 'nullable|integer|min:0',
            'wanita'     => 'nullable|integer|min:0',
            'sekolah'    => 'nullable|integer|min:0',
            'biro'       => 'nullable|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            $stat = Statistic::updateOrCreate(
                ['year' => $validated['year']],
                collect($validated)->except('year')->toArray()
            );
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data statistik tahun ' . $validated['year'] . ' berhasil disimpan.',
                'data'    => $stat,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $stat = Statistic::where('id', $id)->orWhere('year', $id)->firstOrFail();
        return response()->json($stat);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $stat = Statistic::where('id', $id)->orWhere('year', $id)->firstOrFail();
            $year = $stat->year;
            $stat->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data statistik tahun ' . $year . ' berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}

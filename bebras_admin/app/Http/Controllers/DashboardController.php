<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Kegiatan;
use App\Models\Kontak;
use App\Models\Latihan;
use App\Models\SoalBook;
use App\Models\SoalChallenge;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_soal' => SoalChallenge::count(),
            'total_buku' => SoalBook::count(),
            'total_kegiatan' => Kegiatan::count(),
            'total_kontak' => Kontak::count(),
            'total_banner' => Banner::count(),
            'total_latihan' => Latihan::count(),
            'total_admin' => User::count(),
        ];

        // Breakdown soal berdasarkan tingkat (SD, SMP, SMA)
        $soalPerTingkat = SoalChallenge::selectRaw('tingkat, count(*) as total')
            ->groupBy('tingkat')
            ->pluck('total', 'tingkat')
            ->toArray();

        $soalPerTingkat = array_merge([
            'SD' => 0,
            'SMP' => 0,
            'SMA' => 0,
        ], $soalPerTingkat);

        // Breakdown soal berdasarkan kesulitan
        $soalPerKesulitan = SoalChallenge::selectRaw('kesulitan, count(*) as total')
            ->groupBy('kesulitan')
            ->pluck('total', 'kesulitan')
            ->toArray();

        $soalPerKesulitan = array_merge([
            'Mudah' => 0,
            'Menengah' => 0,
            'Sulit' => 0,
        ], $soalPerKesulitan);

        // Ambil 5 kontak masuk terbaru beserta detailnya
        $latestKontak = Kontak::with('details')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'soalPerTingkat', 'soalPerKesulitan', 'latestKontak'));
    }
}

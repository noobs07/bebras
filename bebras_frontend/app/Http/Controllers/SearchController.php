<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $pages = [
        'home, beranda'   => 'home',

        // Tentang Bebras
        'berpikir '       => 'tentangBebras.dd_1',
        'bebras'          => 'tentangBebras.dd_2',
        'tujuan'          => 'tentangBebras.dd_3',
        'lingkup'         => 'tentangBebras.dd_4',
        'kegiatan'        => 'tentangBebras.dd_5',
        'sejarah'         => 'tentangBebras.dd_6',

        // Soal
        'soal'            => 'soal.index-soal',
        'pembahasan soal' => 'soal.pembahasan-soal',
        'siaga sd'        => 'soal.siaga-sd',
        'penggalang smp'  => 'soal.penggalang-smp',
        'penegak sma'     => 'soal.penegak-sma',

        // Kegiatan
        'workshop 2017'   => 'kegiatan.workshop-2017',

        // Halaman lain
        'latihan'         => 'latihan',
        'kontak'          => 'kontak',
    ];

    public function search(Request $request)
    {
        $keyword = \strtolower($request->input('search'));

        foreach ($this->pages as $key => $route) {
            if (str_contains($key, $keyword)) {
                return redirect()->route($route);
            }
        }

        return back()->with('error', 'Halaman tidak ditemukan.');
    }

    public function suggest(Request $request)
    {
        $keyword = \strtolower($request->input('q'));
        $result  = [];

        foreach ($this->pages as $key => $route) {
            if (str_contains($key, $keyword)) {
                $result[] = [
                    'name' => \ucfirst($key),
                    'url'  => route($route),
                ];
            }
        }
    }
}

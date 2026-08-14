<?php

namespace App\Http\Controllers;

use App\Models\MenuSoal;
use App\Models\SoalBook;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function indexSoal()
    {
        $menu = MenuSoal::with('items')->where('slug', 'index-soal')->firstOrFail();
        return view('pages.soal.index_soal', compact('menu'));
    }

    public function pembahasanSoal()
    {
        $books = SoalBook::orderBy('urutan', 'asc')->get()->groupBy('kategori');
        return view('pages.soal.pembahasan_soal', compact('books'));
    }

    public function challenge($slug)
    {
        $menu = MenuSoal::with(['challenges.options'])->where('slug', $slug)->firstOrFail();
        $challenge = $menu->challenges->first();
        return view('pages.soal.' . ($slug === 'siaga-sd' ? 'sd' : ($slug === 'penggalang-smp' ? 'smp' : 'sma')), compact('menu', 'challenge'));
    }
}

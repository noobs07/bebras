<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function workshop2017()
    {
        $workshops = Kegiatan::where('tipe', 'workshop_2017')->orderBy('urutan', 'asc')->get();
        return view('pages.kegiatan.workshop_2017', compact('workshops'));
    }
}

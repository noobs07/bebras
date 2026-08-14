<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Setting;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan', 'asc')->get();
        $kegiatans = Kegiatan::where('tipe', 'kegiatan_utama')->orderBy('urutan', 'asc')->get();
        $aboutLogo = Setting::getByKey('home_about_logo', 'img/logo.jpg');
        $aboutContent = Setting::getByKey('home_about_content');
        $ctaTitle = Setting::getByKey('home_cta_title', 'Bebras Indonesia Challenge 2024');
        $ctaDescription = Setting::getByKey('home_cta_description');
        $ctaLink = Setting::getByKey('home_cta_link', '#');

        return view('pages.home', compact(
            'banners',
            'kegiatans',
            'aboutLogo',
            'aboutContent',
            'ctaTitle',
            'ctaDescription',
            'ctaLink'
        ));
    }
}

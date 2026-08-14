<?php

namespace App\Http\Controllers;

use App\Models\TentangBebras;
use Illuminate\Http\Request;

class TentangBebrasController extends Controller
{
    public function show($slug)
    {
        $page = TentangBebras::with('items')->where('slug', $slug)->firstOrFail();
        $viewName = 'pages.tentangBebras.' . $slug;
        if (!view()->exists($viewName)) {
            $viewName = 'pages.tentangBebras.dd_1';
        }
        return view($viewName, compact('page'));
    }
}

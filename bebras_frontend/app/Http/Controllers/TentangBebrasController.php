<?php

namespace App\Http\Controllers;

use App\Models\TentangBebras;
use Illuminate\Http\Request;

class TentangBebrasController extends Controller
{
    public function show($slug)
    {
        $page = TentangBebras::with('items')->where('slug', $slug)->firstOrFail();
        // Use the stored template, fallback to dd_1 for old/unset rows
        $template = $page->template ?? 'dd_1';
        $viewName = 'pages.tentangBebras.' . $template;
        if (!view()->exists($viewName)) {
            $viewName = 'pages.tentangBebras.dd_1';
        }
        return view($viewName, compact('page'));
    }
}

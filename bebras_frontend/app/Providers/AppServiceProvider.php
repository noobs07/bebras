<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MenuSoal;
use App\Models\MenuKegiatan;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menuSoals = MenuSoal::orderBy('urutan', 'asc')->get();
            $view->with('menuSoals', $menuSoals);

            // Top-level kegiatan menus with their children eager-loaded
            $menuKegiatans = MenuKegiatan::with('children')
                ->whereNull('parent_id')
                ->orderBy('urutan', 'asc')
                ->get();
            $view->with('menuKegiatans', $menuKegiatans);
        });
    }
}

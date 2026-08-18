<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\MenuSoal;
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
        });
    }
}

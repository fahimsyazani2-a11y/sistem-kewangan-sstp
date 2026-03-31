<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- 1. TAMBAH BARIS NI

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
        // 2. TAMBAH LOGIK NI UNTUK PAKSA HTTPS KAT HOSTINGER
        if (app()->environment('production') || config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
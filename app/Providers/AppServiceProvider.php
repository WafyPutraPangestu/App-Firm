<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\DokumenProgres;
use App\Models\Invoice;
use App\Models\Perkara;
use App\Models\ProgresPerkara;
use App\Observers\DashboardCacheObserver;
use App\Services\Admin\DashboardService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DashboardService::class, function ($app) {
            return new DashboardService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate untuk admin
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Gate untuk user
        Gate::define('user', function ($user = null) {
        
            // Cek 1: Jika yang login adalah User Auth (misal ada user role 'user' di tabel users)
            if ($user && $user->role === 'user') {
                return true;
            }
    
            // Cek 2: Jika Auth kosong, CEK SESSION MANUAL (Client)
            // Ini akan mendeteksi login manual kamu
            if (session()->has('client_id')) {
                return true;
            }
    
            // Jika tidak ada keduanya
            return false;
        });

          // Register observers untuk auto-clear cache
          Client::observe(DashboardCacheObserver::class);
          Perkara::observe(DashboardCacheObserver::class);
          ProgresPerkara::observe(DashboardCacheObserver::class);
          Invoice::observe(DashboardCacheObserver::class);
          DokumenProgres::observe(DashboardCacheObserver::class);
    }
}

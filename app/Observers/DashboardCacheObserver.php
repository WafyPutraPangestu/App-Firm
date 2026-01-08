<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

/**
 * Observer untuk clear cache dashboard otomatis saat data berubah
 * 
 * Tambahkan di App\Providers\AppServiceProvider:
 * 
 * public function boot()
 * {
 *     Client::observe(DashboardCacheObserver::class);
 *     Perkara::observe(DashboardCacheObserver::class);
 *     ProgresPerkara::observe(DashboardCacheObserver::class);
 *     Invoice::observe(DashboardCacheObserver::class);
 *     DokumenProgres::observe(DashboardCacheObserver::class);
 * }
 */
class DashboardCacheObserver
{
    /**
     * Handle the "created" event.
     */
    public function created($model)
    {
        $this->clearDashboardCache();
    }

    /**
     * Handle the "updated" event.
     */
    public function updated($model)
    {
        $this->clearDashboardCache();
    }

    /**
     * Handle the "deleted" event.
     */
    public function deleted($model)
    {
        $this->clearDashboardCache();
    }

    /**
     * Clear all dashboard-related caches
     */
    private function clearDashboardCache()
    {
        // Clear simple caches
        Cache::forget('recent_activities');
        Cache::forget('available_years');
        Cache::forget('perkara_chart_data');
        Cache::forget('client_growth_chart_data');
        Cache::forget('realtime_stats');
        
        // Clear period-based caches dengan pattern matching
        $periods = ['all', 'today', 'this_week', 'this_month', 'this_year', 'year'];
        $years = range(2020, now()->year + 1); // Include next year untuk edge cases
        
        foreach ($periods as $period) {
            foreach ($years as $year) {
                Cache::forget("dashboard_stats_{$period}_{$year}");
                Cache::forget("periode_breakdown_{$year}");
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display admin dashboard
     */
    public function index(Request $request)
    {
        $period = $request->input('period', 'all');
        $year = $request->input('year', now()->year);
        
        $stats = $this->dashboardService->getDashboardStats($period, $year);
        $chartData = [
            'perkara' => $this->dashboardService->getPerkaraChartData(),
            'clientGrowth' => $this->dashboardService->getClientGrowthChartData(),
        ];
        
        $availableYears = $this->dashboardService->getAvailableYears();

        return view('admin.dashboard.index', compact('stats', 'chartData', 'availableYears', 'period', 'year'));
    }

    /**
     * API: Get stats by period (untuk filter dinamis)
     */
    public function getStatsByPeriod(Request $request)
    {
        $period = $request->input('period', 'all');
        $year = $request->input('year', now()->year);
        
        $stats = $this->dashboardService->getDashboardStats($period, $year);
        
        return response()->json($stats);
    }

    /**
     * API: Get periode breakdown
     */
    public function getPeriodeBreakdown(Request $request)
    {
        $year = $request->input('year', now()->year);
        $breakdown = $this->dashboardService->getPeriodeBreakdown($year);
        
        return response()->json($breakdown);
    }

    /**
     * API: Get realtime stats (untuk auto-refresh)
     */
    public function getRealtimeStats()
    {
        return response()->json(
            $this->dashboardService->getRealtimeStats()
        );
    }

    /**
     * API: Get recent activities
     */
    public function getRecentActivities()
    {
        $activities = $this->dashboardService->getRecentActivities(20);

        return response()->json([
            'activities' => $activities
        ]);
    }

    /**
     * API: Search
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'clients' => [],
                'perkaras' => []
            ]);
        }

        $results = $this->dashboardService->search($query);

        return response()->json($results);
    }

    /**
     * Clear dashboard cache (useful after data import/migration)
     */
    public function clearCache()
    {
        $this->dashboardService->clearCache();
        
        return response()->json([
            'success' => true,
            'message' => 'Dashboard cache cleared successfully'
        ]);
    }
}
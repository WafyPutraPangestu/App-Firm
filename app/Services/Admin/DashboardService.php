<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\Perkara;
use App\Models\ProgresPerkara;
use App\Models\Invoice;
use App\Models\DokumenProgres;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Get all dashboard statistics with caching
     */
    public function getDashboardStats($period = 'all', $year = null)
    {
        $year = $year ?? Carbon::now()->year;
        $cacheKey = "dashboard_stats_{$period}_{$year}";
        
        return Cache::remember($cacheKey, now()->addMinutes(5), function() use ($period, $year) {
            return [
                'overview' => $this->getOverviewStats($period, $year),
                'clients' => $this->getClientStats($period, $year),
                'perkara' => $this->getPerkaraStats($period, $year),
                'invoices' => $this->getInvoiceStats($period, $year),
                'recent' => $this->getRecentActivities(),
                'performance' => $this->getPerformanceMetrics($period, $year),
                'periode_breakdown' => $this->getPeriodeBreakdown($year),
            ];
        });
    }

    /**
     * Overview Statistics
     */
    public function getOverviewStats($period = 'all', $year = null)
    {
        return [
            'total_clients' => $this->applyPeriodFilter(Client::query(), $period, $year, 'created_at')->count(),
            'active_clients' => $this->applyPeriodFilter(Client::where('status', 'aktif'), $period, $year, 'created_at')->count(),
            'total_perkara' => $this->applyPeriodFilter(Perkara::query(), $period, $year, 'tanggal_mulai')->count(),
            'perkara_berjalan' => $this->applyPeriodFilter(Perkara::where('status', 'berjalan'), $period, $year, 'tanggal_mulai')->count(),
            'perkara_selesai' => $this->applyPeriodFilter(Perkara::where('status', 'selesai'), $period, $year, 'tanggal_mulai')->count(),
            'total_progress' => $this->applyPeriodFilter(ProgresPerkara::query(), $period, $year, 'created_at')->count(),
            'total_invoices' => $this->applyPeriodFilter(Invoice::query(), $period, $year, 'created_at')->count(),
            'invoices_lunas' => $this->applyPeriodFilter(Invoice::where('status', 'lunas'), $period, $year, 'created_at')->count(),
            'invoices_pending' => $this->applyPeriodFilter(Invoice::where('status', 'belum_bayar'), $period, $year, 'created_at')->count(),
            'total_dokumen' => $this->applyPeriodFilter(DokumenProgres::query(), $period, $year, 'created_at')->count(),
        ];
    }

    /**
     * CRITICAL FIX: Periode Breakdown dengan Single Query
     */
    public function getPeriodeBreakdown($year)
    {
        return Cache::remember("periode_breakdown_{$year}", now()->addMinutes(10), function() use ($year) {
            return [
                'hari_ini' => $this->getStatsHariIni(),
                'minggu_ini' => $this->getStatsMingguIni(),
                'bulan_ini' => $this->getStatsBulanIni(),
                'tahun_ini' => $this->getStatsTahunIni($year),
                'per_bulan' => $this->getStatsPerBulanOptimized($year),
                'per_minggu' => $this->getStatsPerMingguOptimized(),
                'per_hari' => $this->getStatsPerHariOptimized(),
            ];
        });
    }

    /**
     * OPTIMIZED: Stats Per Bulan - FROM 12 QUERIES TO 1 QUERY!
     */
    private function getStatsPerBulanOptimized($year)
    {
        // Single query untuk semua bulan menggunakan GROUP BY
        $clientsData = Client::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month');

        $perkaraData = Perkara::selectRaw('MONTH(tanggal_mulai) as month, COUNT(*) as count')
            ->whereYear('tanggal_mulai', $year)
            ->groupBy('month')
            ->pluck('count', 'month');

        $progressData = ProgresPerkara::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month');

        $invoicesData = Invoice::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month');

        // Build result array
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[] = [
                'month' => $month,
                'month_name' => Carbon::create($year, $month)->locale('id')->format('F'),
                'clients' => $clientsData[$month] ?? 0,
                'perkara' => $perkaraData[$month] ?? 0,
                'progress' => $progressData[$month] ?? 0,
                'invoices' => $invoicesData[$month] ?? 0,
            ];
        }

        return $months;
    }

    /**
     * OPTIMIZED: Stats Per Minggu - Single Query
     */
    private function getStatsPerMingguOptimized()
    {
        $weeks = [];
        $weekRanges = [];

        // Prepare week ranges
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weekRanges[] = [
                'start' => $startOfWeek,
                'end' => $endOfWeek,
                'label' => $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M'),
            ];
        }

        // Get all data in single queries
        $fourWeeksAgo = Carbon::now()->subWeeks(3)->startOfWeek();
        
        $clientsData = Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $fourWeeksAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        $perkaraData = Perkara::selectRaw('DATE(tanggal_mulai) as date, COUNT(*) as count')
            ->where('tanggal_mulai', '>=', $fourWeeksAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        $progressData = ProgresPerkara::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $fourWeeksAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        $invoicesData = Invoice::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $fourWeeksAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        // Aggregate by week
        foreach ($weekRanges as $range) {
            $clientsCount = 0;
            $perkaraCount = 0;
            $progressCount = 0;
            $invoicesCount = 0;

            $period = new \DatePeriod($range['start'], new \DateInterval('P1D'), $range['end']->addDay());
            foreach ($period as $date) {
                $dateStr = $date->format('Y-m-d');
                $clientsCount += $clientsData[$dateStr] ?? 0;
                $perkaraCount += $perkaraData[$dateStr] ?? 0;
                $progressCount += $progressData[$dateStr] ?? 0;
                $invoicesCount += $invoicesData[$dateStr] ?? 0;
            }

            $weeks[] = [
                'week_label' => $range['label'],
                'clients' => $clientsCount,
                'perkara' => $perkaraCount,
                'progress' => $progressCount,
                'invoices' => $invoicesCount,
            ];
        }

        return $weeks;
    }

    /**
     * OPTIMIZED: Stats Per Hari - Single Query
     */
    private function getStatsPerHariOptimized()
    {
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();

        // Get all data in single queries
        $clientsData = Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        $perkaraData = Perkara::selectRaw('DATE(tanggal_mulai) as date, COUNT(*) as count')
            ->where('tanggal_mulai', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        $progressData = ProgresPerkara::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        $invoicesData = Invoice::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->pluck('count', 'date');

        // Build result
        $days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');

            $days[] = [
                'date' => $dateStr,
                'day_label' => $date->locale('id')->format('D, d M'),
                'clients' => $clientsData[$dateStr] ?? 0,
                'perkara' => $perkaraData[$dateStr] ?? 0,
                'progress' => $progressData[$dateStr] ?? 0,
                'invoices' => $invoicesData[$dateStr] ?? 0,
            ];
        }

        return $days;
    }

    private function getStatsHariIni()
    {
        $today = Carbon::today();
        return [
            'clients' => Client::whereDate('created_at', $today)->count(),
            'perkara' => Perkara::whereDate('tanggal_mulai', $today)->count(),
            'progress' => ProgresPerkara::whereDate('created_at', $today)->count(),
            'invoices' => Invoice::whereDate('created_at', $today)->count(),
            'dokumen' => DokumenProgres::whereDate('created_at', $today)->count(),
        ];
    }

    private function getStatsMingguIni()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        return [
            'clients' => Client::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
            'perkara' => Perkara::whereBetween('tanggal_mulai', [$startOfWeek, $endOfWeek])->count(),
            'progress' => ProgresPerkara::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
            'invoices' => Invoice::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
            'dokumen' => DokumenProgres::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
        ];
    }

    private function getStatsBulanIni()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        return [
            'clients' => Client::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'perkara' => Perkara::whereBetween('tanggal_mulai', [$startOfMonth, $endOfMonth])->count(),
            'progress' => ProgresPerkara::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'invoices' => Invoice::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'dokumen' => DokumenProgres::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
        ];
    }

    private function getStatsTahunIni($year = null)
    {
        $year = $year ?? Carbon::now()->year;
        
        return [
            'clients' => Client::whereYear('created_at', $year)->count(),
            'perkara' => Perkara::whereYear('tanggal_mulai', $year)->count(),
            'progress' => ProgresPerkara::whereYear('created_at', $year)->count(),
            'invoices' => Invoice::whereYear('created_at', $year)->count(),
            'dokumen' => DokumenProgres::whereYear('created_at', $year)->count(),
        ];
    }

    private function applyPeriodFilter($query, $period, $year = null, $dateColumn = 'created_at')
    {
        if (!$query) {
            return $query;
        }
        
        $year = $year ?? Carbon::now()->year;
        
        switch ($period) {
            case 'today':
                return $query->whereDate($dateColumn, Carbon::today());
            
            case 'this_week':
                return $query->whereBetween($dateColumn, [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            
            case 'this_month':
                return $query->whereBetween($dateColumn, [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]);
            
            case 'this_year':
                return $query->whereYear($dateColumn, Carbon::now()->year);
            
            case 'year':
                return $query->whereYear($dateColumn, $year);
            
            case 'all':
            default:
                return $query;
        }
    }

    public function getAvailableYears()
    {
        return Cache::remember('available_years', now()->addHours(1), function() {
            $earliestClient = Client::min('created_at');
            $earliestPerkara = Perkara::min('tanggal_mulai');
            
            $startYear = $earliestClient ? Carbon::parse($earliestClient)->year : Carbon::now()->year;
            if ($earliestPerkara) {
                $perkaraYear = Carbon::parse($earliestPerkara)->year;
                $startYear = min($startYear, $perkaraYear);
            }
            
            $currentYear = Carbon::now()->year;
            $years = [];
            
            for ($year = $currentYear; $year >= $startYear; $year--) {
                $years[] = $year;
            }
            
            return $years;
        });
    }

    public function getClientStats($period = 'all', $year = null)
    {
        $query = Client::query();
        $query = $this->applyPeriodFilter($query, $period, $year, 'created_at');
        
        return [
            'by_type' => (clone $query)->select('jenis_client', DB::raw('count(*) as total'))
                ->groupBy('jenis_client')
                ->get()
                ->pluck('total', 'jenis_client')
                ->toArray(),
            
            'by_status' => (clone $query)->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status')
                ->toArray(),
        ];
    }

    public function getPerkaraStats($period = 'all', $year = null)
    {
        $query = Perkara::query();
        $query = $this->applyPeriodFilter($query, $period, $year, 'tanggal_mulai');
        
        return [
            'by_type' => (clone $query)->select('jenis_perkara', DB::raw('count(*) as total'))
                ->groupBy('jenis_perkara')
                ->get()
                ->pluck('total', 'jenis_perkara')
                ->toArray(),
            
            'by_status' => (clone $query)->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status')
                ->toArray(),
            
            'avg_duration_completed' => (clone $query)->where('status', 'selesai')
                ->whereNotNull('tanggal_selesai')
                ->selectRaw('AVG(DATEDIFF(tanggal_selesai, tanggal_mulai)) as avg_days')
                ->value('avg_days'),
            
            'avg_duration_ongoing' => (clone $query)->where('status', 'berjalan')
                ->selectRaw('AVG(DATEDIFF(NOW(), tanggal_mulai)) as avg_days')
                ->value('avg_days'),
        ];
    }

    public function getInvoiceStats($period = 'all', $year = null)
    {
        $query = Invoice::query();
        $query = $this->applyPeriodFilter($query, $period, $year, 'created_at');
        
        return [
            'by_status' => (clone $query)->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status')
                ->toArray(),
        ];
    }

    public function getRecentActivities($limit = 10)
    {
        return Cache::remember('recent_activities', now()->addMinutes(2), function() use ($limit) {
            $activities = collect();

            $recentClients = Client::select('id', 'nama_lengkap', 'created_at')
                ->latest()
                ->limit(5)
                ->get()
                ->map(function($client) {
                    return [
                        'type' => 'client',
                        'title' => 'Client Baru: ' . $client->nama_lengkap,
                        'description' => 'Client baru terdaftar',
                        'timestamp' => $client->created_at,
                        'icon' => 'user',
                        'color' => 'blue'
                    ];
                });

            $recentPerkara = Perkara::with('client:id,nama_lengkap')
                ->select('id', 'client_id', 'jenis_perkara', 'status', 'created_at')
                ->latest()
                ->limit(5)
                ->get()
                ->map(function($perkara) {
                    return [
                        'type' => 'perkara',
                        'title' => 'Perkara Baru: ' . $perkara->jenis_perkara,
                        'description' => 'Client: ' . $perkara->client->nama_lengkap,
                        'timestamp' => $perkara->created_at,
                        'icon' => 'document',
                        'color' => 'green'
                    ];
                });

            $recentProgress = ProgresPerkara::with('perkara.client:id,nama_lengkap')
                ->select('id', 'perkara_id', 'judul_progres', 'created_at')
                ->latest()
                ->limit(5)
                ->get()
                ->map(function($progress) {
                    return [
                        'type' => 'progress',
                        'title' => 'Progress: ' . $progress->judul_progres,
                        'description' => 'Perkara: ' . $progress->perkara->jenis_perkara,
                        'timestamp' => $progress->created_at,
                        'icon' => 'check',
                        'color' => 'purple'
                    ];
                });

            return $activities->merge($recentClients)
                ->merge($recentPerkara)
                ->merge($recentProgress)
                ->sortByDesc('timestamp')
                ->take($limit)
                ->values();
        });
    }

    public function getPerformanceMetrics($period = 'all', $year = null)
    {
        return [
            'completion_rate' => $this->getCompletionRate($period, $year),
            'avg_progress_per_perkara' => $this->getAvgProgressPerPerkara($period, $year),
            'most_active_admin' => $this->getMostActiveAdmin($period, $year),
        ];
    }

    private function getCompletionRate($period, $year)
    {
        $totalQuery = Perkara::query();
        $totalQuery = $this->applyPeriodFilter($totalQuery, $period, $year, 'tanggal_mulai');
        $total = $totalQuery->count();
        
        $completedQuery = Perkara::where('status', 'selesai');
        $completedQuery = $this->applyPeriodFilter($completedQuery, $period, $year, 'tanggal_mulai');
        $completed = $completedQuery->count();
        
        return $total > 0 ? round(($completed / $total) * 100, 2) : 0;
    }

    private function getAvgProgressPerPerkara($period, $year)
    {
        $query = ProgresPerkara::query();
        $query = $this->applyPeriodFilter($query, $period, $year, 'created_at');
        
        $result = $query->select(DB::raw('COUNT(*) as total_progress'), DB::raw('COUNT(DISTINCT perkara_id) as total_perkara'))
            ->first();
        
        return $result->total_perkara > 0 ? round($result->total_progress / $result->total_perkara, 1) : 0;
    }

    private function getMostActiveAdmin($period, $year)
    {
        $query = Perkara::query();
        $query = $this->applyPeriodFilter($query, $period, $year, 'tanggal_mulai');
        
        $admin = $query->select('created_by', DB::raw('count(*) as total'))
            ->groupBy('created_by')
            ->orderBy('total', 'desc')
            ->first();

        if ($admin) {
            $user = User::find($admin->created_by);
            return [
                'name' => $user->name ?? 'Unknown',
                'total' => $admin->total
            ];
        }

        return ['name' => '-', 'total' => 0];
    }

    public function getPerkaraChartData()
    {
        return Cache::remember('perkara_chart_data', now()->addMinutes(10), function() {
            $data = Perkara::select(
                    DB::raw('YEAR(tanggal_mulai) as year'),
                    DB::raw('MONTH(tanggal_mulai) as month'),
                    DB::raw('count(*) as total')
                )
                ->where('tanggal_mulai', '>=', Carbon::now()->subMonths(12))
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->keyBy(function($item) {
                    return $item->year . '-' . $item->month;
                });

            $labels = [];
            $values = [];

            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->locale('id')->format('M Y');
                $key = $date->year . '-' . $date->month;
                $values[] = $data[$key]->total ?? 0;
            }

            return [
                'labels' => $labels,
                'values' => $values
            ];
        });
    }

    public function getClientGrowthChartData()
    {
        return Cache::remember('client_growth_chart_data', now()->addMinutes(10), function() {
            $data = Client::select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('count(*) as total')
                )
                ->where('created_at', '>=', Carbon::now()->subMonths(12))
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->keyBy(function($item) {
                    return $item->year . '-' . $item->month;
                });

            $labels = [];
            $values = [];

            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->locale('id')->format('M Y');
                $key = $date->year . '-' . $date->month;
                $values[] = $data[$key]->total ?? 0;
            }

            return [
                'labels' => $labels,
                'values' => $values
            ];
        });
    }

    public function search($query)
    {
        $clients = Client::where('nama_lengkap', 'like', "%{$query}%")
            ->orWhere('nama_perusahaan', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'nama_lengkap', 'nama_perusahaan'])
            ->map(function($client) {
                return [
                    'type' => 'client',
                    'id' => $client->id,
                    'title' => $client->nama_lengkap,
                    'subtitle' => $client->nama_perusahaan,
                    'url' => route('admin.clients.show', $client->id)
                ];
            });

        $perkaras = Perkara::with('client:id,nama_lengkap')
            ->where('jenis_perkara', 'like', "%{$query}%")
            ->orWhere('deskripsi_perkara', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'client_id', 'jenis_perkara'])
            ->map(function($perkara) {
                return [
                    'type' => 'perkara',
                    'id' => $perkara->id,
                    'title' => $perkara->jenis_perkara,
                    'subtitle' => 'Client: ' . $perkara->client->nama_lengkap,
                    'url' => route('admin.perkara.show', ['perkara' => $perkara->id, 'client' => $perkara->client_id])
                ];
            });

        return [
            'clients' => $clients,
            'perkaras' => $perkaras
        ];
    }

    public function getRealtimeStats()
    {
        return Cache::remember('realtime_stats', now()->addSeconds(30), function() {
            return [
                'clients' => [
                    'total' => Client::count(),
                    'active' => Client::where('status', 'aktif')->count(),
                ],
                'perkara' => [
                    'total' => Perkara::count(),
                    'berjalan' => Perkara::where('status', 'berjalan')->count(),
                    'selesai' => Perkara::where('status', 'selesai')->count(),
                ],
                'invoices' => [
                    'total' => Invoice::count(),
                    'lunas' => Invoice::where('status', 'lunas')->count(),
                    'pending' => Invoice::where('status', 'belum_bayar')->count(),
                ],
                'timestamp' => now()->toIso8601String()
            ];
        });
    }

    /**
     * Clear dashboard caches (call this when data changes)
     */
    public function clearCache()
    {
        Cache::forget('recent_activities');
        Cache::forget('available_years');
        Cache::forget('perkara_chart_data');
        Cache::forget('client_growth_chart_data');
        Cache::forget('realtime_stats');
        
        // Clear period-based caches
        $periods = ['all', 'today', 'this_week', 'this_month', 'this_year', 'year'];
        $years = range(2020, now()->year);
        
        foreach ($periods as $period) {
            foreach ($years as $year) {
                Cache::forget("dashboard_stats_{$period}_{$year}");
                Cache::forget("periode_breakdown_{$year}");
            }
        }
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // <--- WAJIB IMPORT INI
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        if (session()->has('client_id')) {
            return redirect()->route('user.clients.dashboard', session('client_id'));
        }
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        
        // Get paginated clients
        $client = Client::with('admin')
            ->latest()
            ->simplePaginate(10);
        
        // Calculate statistics for hero section
        $stats = [
            'total' => Client::count(),
            'aktif' => Client::where('status', 'aktif')->count(),
            'nonaktif' => Client::where('status', 'nonaktif')->count(),
            'retainer' => Client::where('jenis_client', 'retainer')->count(),
            'litigasi' => Client::where('jenis_client', 'litigasi')->count(),
            'non_litigasi' => Client::where('jenis_client', 'non_litigasi')->count(),
        ];
        
        return view('index', compact('client', 'stats'));
    }

    public function login(Request $request, $id)
    {
        $request->validate([
            'client_key' => 'required|string'
        ]);
    
        $client = Client::findOrFail($id);
        
        if (empty($client->client_key)) {
            return response()->json([
                'success' => false,
                'message' => 'Client Key belum dibuat oleh Admin.'
            ], 422);
        }
    
        // Perbandingan langsung (plain text)
        if ($request->client_key !== $client->client_key) {
            return response()->json([
                'success' => false,
                'message' => 'Client key tidak valid'
            ], 422);
        }
    
        if ($client->client_key_expired_at && now()->gt($client->client_key_expired_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Client key sudah expired'
            ], 422);
        }
    
        if ($client->status !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Akun client tidak aktif'
            ], 422);
        }
    
        session(['client_id' => $client->id]);
        session(['client_name' => $client->nama_lengkap]);
    
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'redirect_url' => route('user.clients.dashboard', $client->id)
        ]);
    }

    public function dashboard($id)
    {
        if (!session('client_id') || session('client_id') != $id) {
            return redirect()->route('index')->with('error', 'Silakan login terlebih dahulu');
        }

        $client = Client::with(['perkara', 'chats'])->findOrFail($id);
        
        // Basic Stats
        $stats = [
            'total_perkara' => $client->perkara->count(),
            'perkara_aktif' => $client->perkara->where('status', 'berjalan')->count(),
            'perkara_selesai' => $client->perkara->where('status', 'selesai')->count(),
            
            'tagihan_lunas' => DB::table('invoices')
                ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $id)
                ->where('invoices.status', 'lunas')
                ->count(),
                
            'tagihan_pending' => DB::table('invoices')
                ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $id)
                ->where('invoices.status', 'belum_bayar')
                ->count(),
                
            'total_invoice' => DB::table('invoices')
                ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $id)
                ->count(),
                
            'total_dokumen' => DB::table('dokumen_progres')
                ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $id)
                ->count(),
        ];

        // Chart Data
        $chartData = $this->getChartData($id);
        
        // Detail Data Tables
        $detailData = $this->getDetailData($id);
        
        return view('user.clients.dashboard', compact('client', 'stats', 'chartData', 'detailData'));
    }

    /**
     * Get detailed data untuk tables
     */
    private function getDetailData($clientId)
    {
        return [
            // 1. Daftar Perkara dengan Durasi
            'perkaraDetail' => $this->getPerkaraDetail($clientId),
            
            // 2. Recent Progress (10 terakhir)
            'recentProgress' => $this->getRecentProgress($clientId),
            
            // 3. Invoice Detail
            'invoiceDetail' => $this->getInvoiceDetail($clientId),
            
            // 4. Dokumen Terbaru
            'recentDocuments' => $this->getRecentDocuments($clientId),
            
            // 5. Analisis Durasi
            'analisisDurasi' => $this->getAnalisisDurasi($clientId),
            
            // 6. Timeline Aktivitas (30 hari terakhir)
            'timeline' => $this->getTimeline($clientId),
        ];
    }

    /**
     * Detail Perkara dengan Durasi
     */
    private function getPerkaraDetail($clientId)
    {
        $perkaras = DB::table('perkaras')
            ->select(
                'perkaras.*',
                DB::raw('DATEDIFF(COALESCE(perkaras.tanggal_selesai, NOW()), perkaras.tanggal_mulai) as durasi_hari'),
                DB::raw('(SELECT COUNT(*) FROM progres_perkaras WHERE progres_perkaras.perkara_id = perkaras.id) as total_progress'),
                DB::raw('(SELECT COUNT(*) FROM progres_perkaras 
                         JOIN invoices ON invoices.progres_perkara_id = progres_perkaras.id 
                         WHERE progres_perkaras.perkara_id = perkaras.id) as total_invoice_count'),
                DB::raw('(SELECT COUNT(*) FROM progres_perkaras 
                         JOIN dokumen_progres ON dokumen_progres.progres_perkara_id = progres_perkaras.id 
                         WHERE progres_perkaras.perkara_id = perkaras.id) as total_dokumen_count')
            )
            ->where('perkaras.client_id', $clientId)
            ->orderBy('perkaras.tanggal_mulai', 'desc')
            ->get()
            ->map(function($perkara) {
                $perkara->durasi_formatted = $this->formatDurasi($perkara->durasi_hari);
                $perkara->status_badge = $perkara->status === 'berjalan' ? 'warning' : 'success';
                return $perkara;
            });

        return $perkaras;
    }

    /**
     * Recent Progress
     */
    private function getRecentProgress($clientId)
    {
        return DB::table('progres_perkaras')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                'progres_perkaras.*',
                'perkaras.jenis_perkara',
                DB::raw('DATEDIFF(NOW(), progres_perkaras.tanggal_progres) as hari_lalu')
            )
            ->where('perkaras.client_id', $clientId)
            ->orderBy('progres_perkaras.created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($progress) {
                $progress->waktu_relatif = $this->getWaktuRelatif($progress->hari_lalu);
                return $progress;
            });
    }

    /**
     * Invoice Detail
     */
    private function getInvoiceDetail($clientId)
    {
        return DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                'invoices.*',
                'progres_perkaras.judul_progres',
                'progres_perkaras.urutan',
                'perkaras.jenis_perkara',
                DB::raw('DATEDIFF(NOW(), invoices.created_at) as hari_dibuat')
            )
            ->where('perkaras.client_id', $clientId)
            ->orderBy('invoices.created_at', 'desc')
            ->get()
            ->map(function($invoice) {
                $invoice->waktu_relatif = $this->getWaktuRelatif($invoice->hari_dibuat);
                return $invoice;
            });
    }

    /**
     * Recent Documents
     */
    private function getRecentDocuments($clientId)
    {
        return DB::table('dokumen_progres')
            ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                'dokumen_progres.*',
                'progres_perkaras.judul_progres',
                'progres_perkaras.urutan',
                'perkaras.jenis_perkara',
                DB::raw('DATEDIFF(NOW(), dokumen_progres.created_at) as hari_upload')
            )
            ->where('perkaras.client_id', $clientId)
            ->orderBy('dokumen_progres.created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($dokumen) {
                $dokumen->waktu_relatif = $this->getWaktuRelatif($dokumen->hari_upload);
                return $dokumen;
            });
    }

    /**
     * Analisis Durasi Perkara
     */
    private function getAnalisisDurasi($clientId)
    {
        $selesai = DB::table('perkaras')
            ->select(
                DB::raw('AVG(DATEDIFF(tanggal_selesai, tanggal_mulai)) as rata_rata'),
                DB::raw('MIN(DATEDIFF(tanggal_selesai, tanggal_mulai)) as tercepat'),
                DB::raw('MAX(DATEDIFF(tanggal_selesai, tanggal_mulai)) as terlama'),
                DB::raw('COUNT(*) as total')
            )
            ->where('client_id', $clientId)
            ->where('status', 'selesai')
            ->whereNotNull('tanggal_selesai')
            ->first();

        $berjalan = DB::table('perkaras')
            ->select(
                DB::raw('AVG(DATEDIFF(NOW(), tanggal_mulai)) as rata_rata'),
                DB::raw('MIN(DATEDIFF(NOW(), tanggal_mulai)) as tercepat'),
                DB::raw('MAX(DATEDIFF(NOW(), tanggal_mulai)) as terlama'),
                DB::raw('COUNT(*) as total')
            )
            ->where('client_id', $clientId)
            ->where('status', 'berjalan')
            ->first();

        return [
            'selesai' => [
                'rata_rata' => $selesai->rata_rata ? $this->formatDurasi(round($selesai->rata_rata)) : 'Belum ada data',
                'rata_rata_hari' => round($selesai->rata_rata ?? 0),
                'tercepat' => $selesai->tercepat ? $this->formatDurasi($selesai->tercepat) : '-',
                'terlama' => $selesai->terlama ? $this->formatDurasi($selesai->terlama) : '-',
                'total' => $selesai->total
            ],
            'berjalan' => [
                'rata_rata' => $berjalan->rata_rata ? $this->formatDurasi(round($berjalan->rata_rata)) : 'Belum ada data',
                'rata_rata_hari' => round($berjalan->rata_rata ?? 0),
                'tercepat' => $berjalan->tercepat ? $this->formatDurasi($berjalan->tercepat) : '-',
                'terlama' => $berjalan->terlama ? $this->formatDurasi($berjalan->terlama) : '-',
                'total' => $berjalan->total
            ]
        ];
    }

    /**
     * Timeline Aktivitas (30 hari terakhir)
     */
    private function getTimeline($clientId)
    {
        $events = [];
        
        // Progress events
        $progressEvents = DB::table('progres_perkaras')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                'progres_perkaras.created_at as tanggal',
                DB::raw("'progress' as tipe"),
                'progres_perkaras.judul_progres as judul',
                'perkaras.jenis_perkara as detail'
            )
            ->where('perkaras.client_id', $clientId)
            ->where('progres_perkaras.created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        // Invoice events
        $invoiceEvents = DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                'invoices.created_at as tanggal',
                DB::raw("'invoice' as tipe"),
                DB::raw("CONCAT('Invoice untuk: ', progres_perkaras.judul_progres) as judul"),
                'invoices.status as detail'
            )
            ->where('perkaras.client_id', $clientId)
            ->where('invoices.created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        // Document events
        $documentEvents = DB::table('dokumen_progres')
            ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                'dokumen_progres.created_at as tanggal',
                DB::raw("'dokumen' as tipe"),
                DB::raw("'Dokumen di-upload' as judul"),
                'progres_perkaras.judul_progres as detail'
            )
            ->where('perkaras.client_id', $clientId)
            ->where('dokumen_progres.created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        // Merge and sort
        $events = $progressEvents->concat($invoiceEvents)->concat($documentEvents)
            ->sortByDesc('tanggal')
            ->values();

        return $events;
    }

    /**
     * Format durasi dari hari ke string yang readable
     */
    private function formatDurasi($hari)
    {
        if ($hari < 1) return 'Kurang dari 1 hari';
        if ($hari < 7) return $hari . ' hari';
        if ($hari < 30) return floor($hari / 7) . ' minggu ' . ($hari % 7) . ' hari';
        if ($hari < 365) return floor($hari / 30) . ' bulan ' . floor(($hari % 30) / 7) . ' minggu';
        return floor($hari / 365) . ' tahun ' . floor(($hari % 365) / 30) . ' bulan';
    }

    /**
     * Get waktu relatif (berapa lama yang lalu)
     */
    private function getWaktuRelatif($hari)
    {
        if ($hari < 1) return 'Hari ini';
        if ($hari == 1) return 'Kemarin';
        if ($hari < 7) return $hari . ' hari yang lalu';
        if ($hari < 30) return floor($hari / 7) . ' minggu yang lalu';
        if ($hari < 365) return floor($hari / 30) . ' bulan yang lalu';
        return floor($hari / 365) . ' tahun yang lalu';
    }

    // Chart methods tetap sama seperti sebelumnya...

    /**
     * Get chart data untuk dashboard
     */
    private function getChartData($clientId)
    {
        $now = Carbon::now();
        
        return [
            // 1. Perkara per Bulan (12 bulan terakhir)
            'perkaraPerBulan' => $this->getPerkaraPerBulan($clientId),
            
            // 2. Perkara per Minggu (4 minggu terakhir)
            'perkaraPerMinggu' => $this->getPerkaraPerMinggu($clientId),
            
            // 3. Progress per Bulan (12 bulan terakhir)
            'progressPerBulan' => $this->getProgressPerBulan($clientId),
            
            // 4. Invoice Status Distribution (Pie Chart)
            'invoiceStatus' => $this->getInvoiceStatusDistribution($clientId),
            
            // 5. Perkara by Status (untuk pie chart)
            'perkaraByStatus' => $this->getPerkaraByStatus($clientId),
            
            // 6. Stats per Periode
            'periodeStats' => [
                'hari_ini' => $this->getStatsHariIni($clientId),
                'minggu_ini' => $this->getStatsMingguIni($clientId),
                'bulan_ini' => $this->getStatsBulanIni($clientId),
                'tahun_ini' => $this->getStatsTahunIni($clientId),
            ]
        ];
    }

    /**
     * Perkara per bulan (12 bulan terakhir)
     */
    private function getPerkaraPerBulan($clientId)
    {
        $data = DB::table('perkaras')
            ->select(
                DB::raw('YEAR(tanggal_mulai) as year'),
                DB::raw('MONTH(tanggal_mulai) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('client_id', $clientId)
            ->where('tanggal_mulai', '>=', Carbon::now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Format untuk Chart.js
        $labels = [];
        $values = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->locale('id')->format('M Y');
            
            $found = $data->first(function($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            
            $values[] = $found ? $found->total : 0;
        }

        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

    /**
     * Perkara per minggu (4 minggu terakhir)
     */
    private function getPerkaraPerMinggu($clientId)
    {
        $labels = [];
        $values = [];
        
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $labels[] = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M');
            
            $count = DB::table('perkaras')
                ->where('client_id', $clientId)
                ->whereBetween('tanggal_mulai', [$startOfWeek, $endOfWeek])
                ->count();
            
            $values[] = $count;
        }

        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

    /**
     * Progress per bulan (12 bulan terakhir)
     */
    private function getProgressPerBulan($clientId)
    {
        $data = DB::table('progres_perkaras')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->select(
                DB::raw('YEAR(progres_perkaras.tanggal_progres) as year'),
                DB::raw('MONTH(progres_perkaras.tanggal_progres) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('perkaras.client_id', $clientId)
            ->where('progres_perkaras.tanggal_progres', '>=', Carbon::now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $labels = [];
        $values = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->locale('id')->format('M Y');
            
            $found = $data->first(function($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            
            $values[] = $found ? $found->total : 0;
        }

        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

    /**
     * Invoice Status Distribution
     */
    private function getInvoiceStatusDistribution($clientId)
    {
        $lunas = DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->where('perkaras.client_id', $clientId)
            ->where('invoices.status', 'lunas')
            ->count();

        $belumBayar = DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->where('perkaras.client_id', $clientId)
            ->where('invoices.status', 'belum_bayar')
            ->count();

        return [
            'labels' => ['Lunas', 'Belum Bayar'],
            'values' => [$lunas, $belumBayar],
            'colors' => ['#10b981', '#ef4444']
        ];
    }

    /**
     * Perkara by Status
     */
    private function getPerkaraByStatus($clientId)
    {
        $berjalan = DB::table('perkaras')
            ->where('client_id', $clientId)
            ->where('status', 'berjalan')
            ->count();

        $selesai = DB::table('perkaras')
            ->where('client_id', $clientId)
            ->where('status', 'selesai')
            ->count();

        return [
            'labels' => ['Berjalan', 'Selesai'],
            'values' => [$berjalan, $selesai],
            'colors' => ['#3b82f6', '#10b981']
        ];
    }

    /**
     * Stats Hari Ini
     */
    private function getStatsHariIni($clientId)
    {
        $today = Carbon::today();
        
        return [
            'perkara_baru' => DB::table('perkaras')
                ->where('client_id', $clientId)
                ->whereDate('tanggal_mulai', $today)
                ->count(),
            
            'progress_baru' => DB::table('progres_perkaras')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereDate('progres_perkaras.created_at', $today)
                ->count(),
            
            'dokumen_baru' => DB::table('dokumen_progres')
                ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereDate('dokumen_progres.created_at', $today)
                ->count(),
        ];
    }

    /**
     * Stats Minggu Ini
     */
    private function getStatsMingguIni($clientId)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        return [
            'perkara_baru' => DB::table('perkaras')
                ->where('client_id', $clientId)
                ->whereBetween('tanggal_mulai', [$startOfWeek, $endOfWeek])
                ->count(),
            
            'progress_baru' => DB::table('progres_perkaras')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereBetween('progres_perkaras.created_at', [$startOfWeek, $endOfWeek])
                ->count(),
            
            'dokumen_baru' => DB::table('dokumen_progres')
                ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereBetween('dokumen_progres.created_at', [$startOfWeek, $endOfWeek])
                ->count(),
        ];
    }

    /**
     * Stats Bulan Ini
     */
    private function getStatsBulanIni($clientId)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        return [
            'perkara_baru' => DB::table('perkaras')
                ->where('client_id', $clientId)
                ->whereBetween('tanggal_mulai', [$startOfMonth, $endOfMonth])
                ->count(),
            
            'progress_baru' => DB::table('progres_perkaras')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereBetween('progres_perkaras.created_at', [$startOfMonth, $endOfMonth])
                ->count(),
            
            'dokumen_baru' => DB::table('dokumen_progres')
                ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereBetween('dokumen_progres.created_at', [$startOfMonth, $endOfMonth])
                ->count(),
        ];
    }

    /**
     * Stats Tahun Ini
     */
    private function getStatsTahunIni($clientId)
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        
        return [
            'perkara_baru' => DB::table('perkaras')
                ->where('client_id', $clientId)
                ->whereBetween('tanggal_mulai', [$startOfYear, $endOfYear])
                ->count(),
            
            'progress_baru' => DB::table('progres_perkaras')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereBetween('progres_perkaras.created_at', [$startOfYear, $endOfYear])
                ->count(),
            
            'dokumen_baru' => DB::table('dokumen_progres')
                ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
                ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
                ->where('perkaras.client_id', $clientId)
                ->whereBetween('dokumen_progres.created_at', [$startOfYear, $endOfYear])
                ->count(),
        ];
    }

    
    public function logout()
    {
        session()->forget(['client_id', 'client_name']);
        return redirect()->route('index')->with('success', 'Berhasil logout');
    }

    public function show($id)
{
    if (!session('client_id') || session('client_id') != $id) {
        return redirect()->route('index')->with('error', 'Silakan login terlebih dahulu');
    }

    $client = Client::with([
        'perkara' => function($query) {
            $query->with([
                'suratKuasa',
                'progres' => function($q) {
                    $q->orderBy('tanggal_progres', 'desc');
                },
                'invoices',
                'documents',
            ]);
        },
        'chats.admin',
        'admin'
    ])->findOrFail($id);

    // Statistics
    $stats = [
        'total_perkara' => $client->perkara->count(),
        'perkara_aktif' => $client->perkara->where('status', 'berjalan')->count(),
        'perkara_selesai' => $client->perkara->where('status', 'selesai')->count(),
        
        'tagihan_lunas' => DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->where('perkaras.client_id', $id)
            ->where('invoices.status', 'lunas')
            ->count(),
            
        'tagihan_pending' => DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->where('perkaras.client_id', $id)
            ->where('invoices.status', 'belum_bayar')
            ->count(),
            
        'total_invoice' => DB::table('invoices')
            ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->where('perkaras.client_id', $id)
            ->count(),
            
        'total_dokumen' => DB::table('dokumen_progres')
            ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
            ->join('perkaras', 'progres_perkaras.perkara_id', '=', 'perkaras.id')
            ->where('perkaras.client_id', $id)
            ->count(),
    ];

    return view('user.clients.show', compact('client', 'stats'));
}

    public function getInvoices($id, $perkaraId)
    {
        try {
            if (!session('client_id') || session('client_id') != $id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
    
            $client = Client::findOrFail($id);
            $perkara = $client->perkara()->findOrFail($perkaraId);
            
            // JOIN dengan progres_perkaras untuk ambil judul_progres dan urutan
            $invoices = DB::table('invoices')
                ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
                ->where('progres_perkaras.perkara_id', $perkaraId)
                ->select(
                    'invoices.*',
                    'progres_perkaras.judul_progres',
                    'progres_perkaras.urutan'
                )
                ->orderBy('progres_perkaras.urutan', 'asc')
                ->get();
    
            return response()->json([
                'success' => true,
                'invoices' => $invoices
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error in getInvoices: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Gagal memuat data invoice',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getProgress($id, $perkaraId)
    {
        try {
            if (!session('client_id') || session('client_id') != $id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
    
            $client = Client::findOrFail($id);
            $perkara = $client->perkara()->findOrFail($perkaraId);
            $progress = $perkara->progres()
                ->orderBy('tanggal_progres', 'desc')
                ->get();
    
            return response()->json([
                'success' => true,
                'progress' => $progress
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error in getProgress: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Gagal memuat data progress'
            ], 500);
        }
    }
    
   public function getDocuments($id, $perkaraId)
{
    try {
        if (!session('client_id') || session('client_id') != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $client = Client::findOrFail($id);
        $perkara = $client->perkara()->findOrFail($perkaraId);
        
        // JOIN dengan progres_perkaras untuk ambil judul_progres dan urutan
        $documents = DB::table('dokumen_progres')
            ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
            ->where('progres_perkaras.perkara_id', $perkaraId)
            ->select(
                'dokumen_progres.*',
                'progres_perkaras.judul_progres',
                'progres_perkaras.urutan'
            )
            ->orderBy('progres_perkaras.urutan', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'documents' => $documents
        ]);

    } catch (\Exception $e) {
        Log::error('Error in getDocuments: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'error' => 'Gagal memuat data dokumen'
        ], 500);
    }
}
    
    public function downloadInvoice($id, $perkaraId, $invoiceId)
    {
        try {
            if (!session('client_id') || session('client_id') != $id) {
                abort(403, 'Unauthorized');
            }
    
            // FIXED: Menggunakan progres_perkaras
            $invoice = DB::table('invoices')
                ->join('progres_perkaras', 'invoices.progres_perkara_id', '=', 'progres_perkaras.id')
                ->where('progres_perkaras.perkara_id', $perkaraId)
                ->where('invoices.id', $invoiceId)
                ->select('invoices.*')
                ->first();
    
            if (!$invoice) {
                abort(404, 'Invoice tidak ditemukan');
            }
    
            if ($invoice->file_invoice && Storage::exists($invoice->file_invoice)) {
                $filename = 'Invoice-' . ($invoice->nomor_invoice ?? $invoice->id) . '.pdf';
                return Storage::download($invoice->file_invoice, $filename);
            }
    
            abort(404, 'File invoice tidak ditemukan');
    
        } catch (\Exception $e) {
            Log::error('Error downloading invoice: ' . $e->getMessage());
            abort(404, 'File tidak ditemukan');
        }
    }
    
    public function downloadDocument($id, $perkaraId, $documentId)
    {
        try {
            if (!session('client_id') || session('client_id') != $id) {
                abort(403, 'Unauthorized');
            }
            
            // FIXED: Menggunakan progres_perkaras
            $document = DB::table('dokumen_progres')
                ->join('progres_perkaras', 'dokumen_progres.progres_perkara_id', '=', 'progres_perkaras.id')
                ->where('progres_perkaras.perkara_id', $perkaraId)
                ->where('dokumen_progres.id', $documentId)
                ->select('dokumen_progres.*')
                ->first();
    
            if (!$document) {
                abort(404, 'Dokumen tidak ditemukan');
            }
    
            if ($document->file_path && Storage::exists($document->file_path)) {
                $filename = $document->nama_file ?? 'Dokumen-' . $document->id;
                return Storage::download($document->file_path, $filename);
            }
    
            abort(404, 'File dokumen tidak ditemukan');
    
        } catch (\Exception $e) {
            Log::error('Error downloading document: ' . $e->getMessage());
            abort(404, 'File tidak ditemukan');
        }

}
}
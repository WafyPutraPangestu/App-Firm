<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-red-800 to-red-900 text-white shadow-xl">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold mb-1">Dashboard Admin</h1>
                        <p class="text-red-100 text-sm">Selamat datang, {{ auth()->user()->name }}</p>
                    </div>
                    <div class="text-right text-sm">
                        <p class="text-red-100">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="mt-4 flex flex-wrap gap-3">
                    <select id="periodSelect" class="bg-red-700 text-white px-4 py-2 rounded-lg border border-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 text-sm">
                        <option value="all">Semua Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="this_year">Tahun Ini</option>
                        <option value="year">Per Tahun</option>
                    </select>

                    <select id="yearSelect" class="bg-red-700 text-white px-4 py-2 rounded-lg border border-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 text-sm hidden">
                        @foreach($availableYears as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>

                    <span id="loadingIndicator" class="hidden text-red-100 px-4 py-2 text-sm">
                        <svg class="animate-spin h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Loading...
                    </span>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-6">
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Clients -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <div class="bg-gradient-to-br from-red-600 to-red-700 p-4 rounded-xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-red-100 text-xs font-medium">Total Klien</p>
                                <h3 class="text-3xl font-bold text-white mt-1" id="totalClients">{{ $stats['overview']['total_clients'] }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-red-100 text-xs">
                            <span class="font-semibold" id="activeClients">{{ $stats['overview']['active_clients'] }}</span> Klien Aktif
                        </div>
                    </div>
                </div>

                <!-- Total Perkara -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <div class="bg-gradient-to-br from-red-700 to-red-800 p-4 rounded-xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-red-100 text-xs font-medium">Total Perkara</p>
                                <h3 class="text-3xl font-bold text-white mt-1" id="totalPerkara">{{ $stats['overview']['total_perkara'] }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 flex gap-3 text-red-100 text-xs">
                            <span><strong id="perkaraRunning">{{ $stats['overview']['perkara_berjalan'] }}</strong> Berjalan</span>
                            <span><strong id="perkaraCompleted">{{ $stats['overview']['perkara_selesai'] }}</strong> Selesai</span>
                        </div>
                    </div>
                </div>

                <!-- Total Invoice -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <div class="bg-gradient-to-br from-red-800 to-red-900 p-4 rounded-xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-red-100 text-xs font-medium">Total Invoice</p>
                                <h3 class="text-3xl font-bold text-white mt-1" id="totalInvoices">{{ $stats['overview']['total_invoices'] }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 flex gap-3 text-red-100 text-xs">
                            <span><strong id="invoicesPaid">{{ $stats['overview']['invoices_lunas'] }}</strong> Lunas</span>
                            <span><strong id="invoicesPending">{{ $stats['overview']['invoices_pending'] }}</strong> Pending</span>
                        </div>
                    </div>
                </div>

                <!-- Total Progress -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <div class="bg-gradient-to-br from-red-900 to-red-950 p-4 rounded-xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-red-100 text-xs font-medium">Total Progress</p>
                                <h3 class="text-3xl font-bold text-white mt-1" id="totalProgress">{{ $stats['overview']['total_progress'] }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-red-100 text-xs">
                            <span><strong id="totalDokumen">{{ $stats['overview']['total_dokumen'] }}</strong> Total Dokumen</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                <!-- Perkara Chart -->
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-bold text-red-800 mb-3">Statistik Perkara (12 Bulan)</h3>
                    <div style="position: relative; height: 250px;">
                        <canvas id="perkaraChart"></canvas>
                    </div>
                </div>

                <!-- Client Growth Chart -->
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-bold text-red-800 mb-3">Pertumbuhan Klien (12 Bulan)</h3>
                    <div style="position: relative; height: 250px;">
                        <canvas id="clientChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Statistics Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                <!-- Client Statistics -->
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-bold text-red-800 mb-3 flex items-center">
                        <span class="bg-red-100 p-1.5 rounded-lg mr-2">
                            <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        Statistik Klien
                    </h3>
                    <div class="space-y-2" id="clientStats">
                        <div class="flex justify-between items-center p-2 bg-red-50 rounded-lg text-sm">
                            <span class="text-gray-700">Individu</span>
                            <span class="font-bold text-red-800">{{ $stats['clients']['by_type']['individu'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-red-50 rounded-lg text-sm">
                            <span class="text-gray-700">Perusahaan</span>
                            <span class="font-bold text-red-800">{{ $stats['clients']['by_type']['perusahaan'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-green-50 rounded-lg text-sm">
                            <span class="text-gray-700">Aktif</span>
                            <span class="font-bold text-green-700">{{ $stats['clients']['by_status']['aktif'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded-lg text-sm">
                            <span class="text-gray-700">Tidak Aktif</span>
                            <span class="font-bold text-gray-700">{{ $stats['clients']['by_status']['tidak_aktif'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Perkara Statistics -->
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-bold text-red-800 mb-3 flex items-center">
                        <span class="bg-red-100 p-1.5 rounded-lg mr-2">
                            <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        Statistik Perkara
                    </h3>
                    <div class="space-y-2" id="perkaraStats">
                        @foreach($stats['perkara']['by_type'] ?? [] as $type => $count)
                        <div class="flex justify-between items-center p-2 bg-red-50 rounded-lg text-sm">
                            <span class="text-gray-700 capitalize">{{ $type }}</span>
                            <span class="font-bold text-red-800">{{ $count }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-bold text-red-800 mb-3 flex items-center">
                        <span class="bg-red-100 p-1.5 rounded-lg mr-2">
                            <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </span>
                        Metrik Performa
                    </h3>
                    <div class="space-y-3" id="performanceStats">
                        <div class="p-3 bg-gradient-to-r from-red-50 to-red-100 rounded-lg">
                            <p class="text-gray-600 text-xs mb-1">Tingkat Penyelesaian</p>
                            <div class="flex items-end justify-between">
                                <span class="text-2xl font-bold text-red-800">{{ $stats['performance']['completion_rate'] }}%</span>
                                <div class="w-16 h-1.5 bg-red-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-red-600" style="width: {{ $stats['performance']['completion_rate'] }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-xs mb-1">Rata-rata Progress</p>
                            <span class="text-xl font-bold text-red-800">{{ $stats['performance']['avg_progress_per_perkara'] }}</span>
                            <span class="text-gray-600 text-xs ml-1">per perkara</span>
                        </div>

                        <div class="p-3 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-xs mb-1">Admin Teraktif</p>
                            <p class="text-base font-bold text-red-800">{{ $stats['performance']['most_active_admin']['name'] }}</p>
                            <p class="text-xs text-gray-600">{{ $stats['performance']['most_active_admin']['total'] }} perkara</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-xl shadow p-4">
                <h3 class="text-lg font-bold text-red-800 mb-4 flex items-center">
                    <span class="bg-red-100 p-1.5 rounded-lg mr-2">
                        <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Aktivitas Terbaru
                </h3>
                <div class="space-y-3" id="recentActivities">
                    @foreach($stats['recent']->take(5) as $activity)
                    <div class="flex items-start p-3 hover:bg-red-50 rounded-lg transition border-l-4 border-{{ $activity['color'] }}-500">
                        <div class="bg-{{ $activity['color'] }}-100 p-1.5 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($activity['icon'] == 'user')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                @elseif($activity['icon'] == 'document')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @endif
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-800 text-sm">{{ $activity['title'] }}</h4>
                            <p class="text-xs text-gray-600 truncate">{{ $activity['description'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $activity['timestamp']->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        let perkaraChart, clientChart;
        
        // Initialize charts
        function initCharts(perkaraData, clientData) {
            const chartConfig = {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2.5,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 10 } }
                    },
                    x: {
                        ticks: { font: { size: 10 } }
                    }
                }
            };

            // Destroy existing charts
            if (perkaraChart) perkaraChart.destroy();
            if (clientChart) clientChart.destroy();

            // Perkara Chart
            const perkaraCtx = document.getElementById('perkaraChart').getContext('2d');
            perkaraChart = new Chart(perkaraCtx, {
                type: 'line',
                data: {
                    labels: perkaraData.labels,
                    datasets: [{
                        data: perkaraData.values,
                        borderColor: 'rgb(153, 27, 27)',
                        backgroundColor: 'rgba(153, 27, 27, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: chartConfig
            });

            // Client Chart
            const clientCtx = document.getElementById('clientChart').getContext('2d');
            clientChart = new Chart(clientCtx, {
                type: 'bar',
                data: {
                    labels: clientData.labels,
                    datasets: [{
                        data: clientData.values,
                        backgroundColor: 'rgba(153, 27, 27, 0.8)',
                        borderColor: 'rgb(153, 27, 27)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: chartConfig
            });
        }

        // Initialize on load
        initCharts(
            {!! json_encode($chartData['perkara']) !!},
            {!! json_encode($chartData['clientGrowth']) !!}
        );

        // Filter handler
        const periodSelect = document.getElementById('periodSelect');
        const yearSelect = document.getElementById('yearSelect');
        const loadingIndicator = document.getElementById('loadingIndicator');

        periodSelect.addEventListener('change', function() {
            if (this.value === 'year') {
                yearSelect.classList.remove('hidden');
            } else {
                yearSelect.classList.add('hidden');
                loadStats();
            }
        });

        yearSelect.addEventListener('change', loadStats);

        function loadStats() {
            const period = periodSelect.value;
            const year = yearSelect.value;
            
            loadingIndicator.classList.remove('hidden');

            fetch(`{{ route('admin.api.stats-by-period') }}?period=${period}&year=${year}`)
                .then(response => response.json())
                .then(data => {
                    // Update overview cards
                    document.getElementById('totalClients').textContent = data.overview.total_clients;
                    document.getElementById('activeClients').textContent = data.overview.active_clients;
                    document.getElementById('totalPerkara').textContent = data.overview.total_perkara;
                    document.getElementById('perkaraRunning').textContent = data.overview.perkara_berjalan;
                    document.getElementById('perkaraCompleted').textContent = data.overview.perkara_selesai;
                    document.getElementById('totalInvoices').textContent = data.overview.total_invoices;
                    document.getElementById('invoicesPaid').textContent = data.overview.invoices_lunas;
                    document.getElementById('invoicesPending').textContent = data.overview.invoices_pending;
                    document.getElementById('totalProgress').textContent = data.overview.total_progress;
                    document.getElementById('totalDokumen').textContent = data.overview.total_dokumen;

                    // Update client stats
                    let clientStatsHtml = '';
                    clientStatsHtml += `<div class="flex justify-between items-center p-2 bg-red-50 rounded-lg text-sm"><span class="text-gray-700">Individu</span><span class="font-bold text-red-800">${data.clients.by_type.individu || 0}</span></div>`;
                    clientStatsHtml += `<div class="flex justify-between items-center p-2 bg-red-50 rounded-lg text-sm"><span class="text-gray-700">Perusahaan</span><span class="font-bold text-red-800">${data.clients.by_type.perusahaan || 0}</span></div>`;
                    clientStatsHtml += `<div class="flex justify-between items-center p-2 bg-green-50 rounded-lg text-sm"><span class="text-gray-700">Aktif</span><span class="font-bold text-green-700">${data.clients.by_status.aktif || 0}</span></div>`;
                    clientStatsHtml += `<div class="flex justify-between items-center p-2 bg-gray-50 rounded-lg text-sm"><span class="text-gray-700">Tidak Aktif</span><span class="font-bold text-gray-700">${data.clients.by_status.tidak_aktif || 0}</span></div>`;
                    document.getElementById('clientStats').innerHTML = clientStatsHtml;

                    // Update perkara stats
                    let perkaraStatsHtml = '';
                    for (let type in data.perkara.by_type) {
                        perkaraStatsHtml += `<div class="flex justify-between items-center p-2 bg-red-50 rounded-lg text-sm"><span class="text-gray-700 capitalize">${type}</span><span class="font-bold text-red-800">${data.perkara.by_type[type]}</span></div>`;
                    }
                    document.getElementById('perkaraStats').innerHTML = perkaraStatsHtml;

                    // Update performance
                    const perfHtml = `
                        <div class="p-3 bg-gradient-to-r from-red-50 to-red-100 rounded-lg">
                            <p class="text-gray-600 text-xs mb-1">Tingkat Penyelesaian</p>
                            <div class="flex items-end justify-between">
                                <span class="text-2xl font-bold text-red-800">${data.performance.completion_rate}%</span>
                                <div class="w-16 h-1.5 bg-red-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-red-600" style="width: ${data.performance.completion_rate}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-xs mb-1">Rata-rata Progress</p>
                            <span class="text-xl font-bold text-red-800">${data.performance.avg_progress_per_perkara}</span>
                            <span class="text-gray-600 text-xs ml-1">per perkara</span>
                        </div>
                        <div class="p-3 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-xs mb-1">Admin Teraktif</p>
                            <p class="text-base font-bold text-red-800">${data.performance.most_active_admin.name}</p>
                            <p class="text-xs text-gray-600">${data.performance.most_active_admin.total} perkara</p>
                        </div>
                    `;
                    document.getElementById('performanceStats').innerHTML = perfHtml;

                    loadingIndicator.classList.add('hidden');
                })
                .catch(error => {
                    console.error('Error loading stats:', error);
                    loadingIndicator.classList.add('hidden');
                });
        }
    </script>
</x-layout>
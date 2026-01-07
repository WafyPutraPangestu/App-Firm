<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-red-50 to-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-red-900">Dashboard</h1>
                <p class="text-red-700">Selamat datang, {{ $client->nama_lengkap }}</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card stats seperti biasa -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-800 hover:shadow-xl transition-shadow">
                    <p class="text-red-700 text-sm font-semibold uppercase">Total Perkara</p>
                    <p class="text-3xl font-bold text-red-900 mt-2">{{ $stats['total_perkara'] }}</p>
                </div>
                <!-- ... card lainnya ... -->
            </div>

            <!-- Periode Stats Tabs -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border-t-4 border-red-800">
                <h2 class="text-xl font-bold text-red-900 mb-4">Statistik Periode</h2>
                
                <div x-data="{ activeTab: 'hari_ini' }" class="space-y-4">
                    <!-- Tabs -->
                    <div class="flex gap-2 border-b border-red-200">
                        <button @click="activeTab = 'hari_ini'" 
                                :class="activeTab === 'hari_ini' ? 'border-b-2 border-red-800 text-red-800' : 'text-gray-600 hover:text-red-700'"
                                class="px-4 py-2 font-semibold transition-colors">
                            Hari Ini
                        </button>
                        <button @click="activeTab = 'minggu_ini'" 
                                :class="activeTab === 'minggu_ini' ? 'border-b-2 border-red-800 text-red-800' : 'text-gray-600 hover:text-red-700'"
                                class="px-4 py-2 font-semibold transition-colors">
                            Minggu Ini
                        </button>
                        <button @click="activeTab = 'bulan_ini'" 
                                :class="activeTab === 'bulan_ini' ? 'border-b-2 border-red-800 text-red-800' : 'text-gray-600 hover:text-red-700'"
                                class="px-4 py-2 font-semibold transition-colors">
                            Bulan Ini
                        </button>
                        <button @click="activeTab = 'tahun_ini'" 
                                :class="activeTab === 'tahun_ini' ? 'border-b-2 border-red-800 text-red-800' : 'text-gray-600 hover:text-red-700'"
                                class="px-4 py-2 font-semibold transition-colors">
                            Tahun Ini
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <!-- Hari Ini -->
                        <div x-show="activeTab === 'hari_ini'" class="col-span-3 grid grid-cols-3 gap-4">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Perkara Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['hari_ini']['perkara_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Progress Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['hari_ini']['progress_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Dokumen Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['hari_ini']['dokumen_baru'] }}</p>
                            </div>
                        </div>

                        <!-- Minggu Ini -->
                        <div x-show="activeTab === 'minggu_ini'" class="col-span-3 grid grid-cols-3 gap-4">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Perkara Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['minggu_ini']['perkara_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Progress Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['minggu_ini']['progress_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Dokumen Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['minggu_ini']['dokumen_baru'] }}</p>
                            </div>
                        </div>

                        <!-- Bulan Ini -->
                        <div x-show="activeTab === 'bulan_ini'" class="col-span-3 grid grid-cols-3 gap-4">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Perkara Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['bulan_ini']['perkara_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Progress Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['bulan_ini']['progress_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Dokumen Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['bulan_ini']['dokumen_baru'] }}</p>
                            </div>
                        </div>

                        <!-- Tahun Ini -->
                        <div x-show="activeTab === 'tahun_ini'" class="col-span-3 grid grid-cols-3 gap-4">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Perkara Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['tahun_ini']['perkara_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Progress Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['tahun_ini']['progress_baru'] }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
                                <p class="text-sm text-red-700 font-semibold">Dokumen Baru</p>
                                <p class="text-2xl font-bold text-red-900">{{ $chartData['periodeStats']['tahun_ini']['dokumen_baru'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                <!-- Chart 1: Perkara per Bulan (Line Chart) -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-800">
                    <h3 class="text-lg font-bold text-red-900 mb-4">Perkara per Bulan (12 Bulan Terakhir)</h3>
                    <canvas id="chartPerkaraPerBulan"></canvas>
                </div>

                <!-- Chart 2: Perkara per Minggu (Bar Chart) -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-800">
                    <h3 class="text-lg font-bold text-red-900 mb-4">Perkara per Minggu (4 Minggu Terakhir)</h3>
                    <canvas id="chartPerkaraPerMinggu"></canvas>
                </div>

                <!-- Chart 3: Progress per Bulan (Line Chart) -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-800">
                    <h3 class="text-lg font-bold text-red-900 mb-4">Progress per Bulan (12 Bulan Terakhir)</h3>
                    <canvas id="chartProgressPerBulan"></canvas>
                </div>

                <!-- Chart 4: Invoice Status (Pie Chart) -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-800">
                    <h3 class="text-lg font-bold text-red-900 mb-4">Status Invoice</h3>
                    <canvas id="chartInvoiceStatus"></canvas>
                </div>

                <!-- Chart 5: Perkara by Status (Doughnut Chart) -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-800">
                    <h3 class="text-lg font-bold text-red-900 mb-4">Status Perkara</h3>
                    <canvas id="chartPerkaraStatus"></canvas>
                </div>
            </div>

            <!-- Analisis Durasi Perkara -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Perkara Selesai -->
                <div class="bg-gradient-to-br from-green-50 to-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Analisis Perkara Selesai
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-green-100">
                            <span class="text-sm font-semibold text-gray-600">Rata-rata Durasi:</span>
                            <span class="text-lg font-bold text-green-600">{{ $detailData['analisisDurasi']['selesai']['rata_rata'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-green-100">
                            <span class="text-sm font-semibold text-gray-600">Tercepat:</span>
                            <span class="text-lg font-bold text-blue-600">{{ $detailData['analisisDurasi']['selesai']['tercepat'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-green-100">
                            <span class="text-sm font-semibold text-gray-600">Terlama:</span>
                            <span class="text-lg font-bold text-orange-600">{{ $detailData['analisisDurasi']['selesai']['terlama'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-green-100 rounded-lg border border-green-200">
                            <span class="text-sm font-semibold text-gray-700">Total Perkara:</span>
                            <span class="text-2xl font-bold text-green-700">{{ $detailData['analisisDurasi']['selesai']['total'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Perkara Berjalan -->
                <div class="bg-gradient-to-br from-red-50 to-white rounded-xl shadow-lg p-6 border-l-4 border-red-800">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Analisis Perkara Berjalan
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-red-100">
                            <span class="text-sm font-semibold text-gray-600">Rata-rata Durasi:</span>
                            <span class="text-lg font-bold text-red-800">{{ $detailData['analisisDurasi']['berjalan']['rata_rata'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-red-100">
                            <span class="text-sm font-semibold text-gray-600">Terbaru:</span>
                            <span class="text-lg font-bold text-green-600">{{ $detailData['analisisDurasi']['berjalan']['tercepat'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-red-100">
                            <span class="text-sm font-semibold text-gray-600">Terlama:</span>
                            <span class="text-lg font-bold text-orange-600">{{ $detailData['analisisDurasi']['berjalan']['terlama'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-red-100 rounded-lg border border-red-200">
                            <span class="text-sm font-semibold text-gray-700">Total Perkara:</span>
                            <span class="text-2xl font-bold text-red-900">{{ $detailData['analisisDurasi']['berjalan']['total'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Perkara dengan Durasi -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4 bg-gradient-to-r from-red-800 to-red-900">
                    <h3 class="text-xl font-bold text-white">Detail Semua Perkara</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Jenis Perkara</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Tanggal Mulai</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Durasi</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-red-900 uppercase">Progress</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-red-900 uppercase">Invoice</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-red-900 uppercase">Dokumen</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-red-900 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-red-100">
                            @forelse($detailData['perkaraDetail'] as $perkara)
                                <tr class="hover:bg-red-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $perkara->jenis_perkara }}</div>
                                        <div class="text-xs text-gray-500">{{ $perkara->deskripsi_perkara }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($perkara->tanggal_mulai)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-red-100 text-red-900 rounded-full text-xs font-semibold">
                                            {{ $perkara->durasi_formatted }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 bg-red-100 text-red-900 rounded-full text-sm font-bold">
                                            {{ $perkara->total_progress }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm font-bold">
                                            {{ $perkara->total_invoice_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-bold">
                                            {{ $perkara->total_dokumen_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($perkara->status === 'berjalan')
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Berjalan</span>
                                        @else
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada data perkara
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Timeline Aktivitas -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border-t-4 border-red-800">
                <h3 class="text-xl font-bold text-red-900 mb-6">Timeline Aktivitas (30 Hari Terakhir)</h3>
                <div class="space-y-4">
                    @forelse($detailData['timeline'] as $event)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                @if($event->tipe === 'progress')
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                @elseif($event->tipe === 'invoice')
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 bg-red-50 rounded-lg p-4 border border-red-100">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-semibold text-red-900">{{ $event->judul }}</h4>
                                    <span class="text-xs text-red-700">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y, H:i') }}</span>
                                </div>
                                <p class="text-sm text-gray-700">{{ $event->detail }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Progress -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4 bg-gradient-to-r from-red-800 to-red-900">
                    <h3 class="text-xl font-bold text-white">Progress Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Urutan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Judul Progress</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Jenis Perkara</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-red-100">
                            @forelse($detailData['recentProgress'] as $progress)
                                <tr class="hover:bg-red-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-red-100 text-red-900 rounded-full text-xs font-bold">
                                            #{{ $progress->urutan }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $progress->judul_progres }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $progress->jenis_perkara }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($progress->tanggal_progres)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $progress->waktu_relatif }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada progress
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Detail -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4 bg-gradient-to-r from-red-800 to-red-900">
                    <h3 class="text-xl font-bold text-white">Daftar Invoice</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Progress</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Jenis Perkara</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-red-900 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-red-900 uppercase">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-red-100">
                            @forelse($detailData['invoiceDetail'] as $invoice)
                                <tr class="hover:bg-red-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $invoice->judul_progres }}</div>
                                        <div class="text-xs text-gray-500">Progres #{{ $invoice->urutan }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $invoice->jenis_perkara }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($invoice->status === 'lunas')
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Lunas</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $invoice->waktu_relatif }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada invoice
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <script>
        // Data dari Controller
        const chartData = @json($chartData);

        // Chart 1: Perkara per Bulan (Line Chart) - Red theme
        new Chart(document.getElementById('chartPerkaraPerBulan'), {
            type: 'line',
            data: {
                labels: chartData.perkaraPerBulan.labels,
                datasets: [{
                    label: 'Jumlah Perkara',
                    data: chartData.perkaraPerBulan.values,
                    borderColor: 'rgb(153, 27, 27)',
                    backgroundColor: 'rgba(153, 27, 27, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Chart 2: Perkara per Minggu (Bar Chart) - Red theme
        new Chart(document.getElementById('chartPerkaraPerMinggu'), {
            type: 'bar',
            data: {
                labels: chartData.perkaraPerMinggu.labels,
                datasets: [{
                    label: 'Jumlah Perkara',
                    data: chartData.perkaraPerMinggu.values,
                    backgroundColor: 'rgba(153, 27, 27, 0.8)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Chart 3: Progress per Bulan (Line Chart) - Red theme
        new Chart(document.getElementById('chartProgressPerBulan'), {
            type: 'line',
            data: {
                labels: chartData.progressPerBulan.labels,
                datasets: [{
                    label: 'Jumlah Progress',
                    data: chartData.progressPerBulan.values,
                    borderColor: 'rgb(185, 28, 28)',
                    backgroundColor: 'rgba(185, 28, 28, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Chart 4: Invoice Status (Pie Chart)
        new Chart(document.getElementById('chartInvoiceStatus'), {
            type: 'pie',
            data: {
                labels: chartData.invoiceStatus.labels,
                datasets: [{
                    data: chartData.invoiceStatus.values,
                    backgroundColor: chartData.invoiceStatus.colors
                }]
            },
            options: {
                responsive: true
            }
        });

        // Chart 5: Perkara by Status (Doughnut Chart)
        new Chart(document.getElementById('chartPerkaraStatus'), {
            type: 'doughnut',
            data: {
                labels: chartData.perkaraByStatus.labels,
                datasets: [{
                    data: chartData.perkaraByStatus.values,
                    backgroundColor: chartData.perkaraByStatus.colors
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</x-layout>
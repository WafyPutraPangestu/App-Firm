<x-layout>
    <div class="min-h-screen bg-gray-50" x-data="clientPortal()">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-900 via-red-800 to-red-900 text-white shadow-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Portal Client</h1>
                        <p class="text-red-100 mt-1">{{ $client->nama_lengkap }} - {{ $client->nama_perusahaan }}</p>
                    </div>
                    <form action="{{ route('user.clients.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-white text-red-800 font-semibold rounded-lg hover:bg-red-50 transition-all">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Perkara -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Total Perkara</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_perkara'] }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-600 font-semibold">{{ $stats['perkara_aktif'] }} Aktif</span>
                        <span class="mx-2 text-gray-400">|</span>
                        <span class="text-gray-600">{{ $stats['perkara_selesai'] }} Selesai</span>
                    </div>
                </div>

                <!-- Total Invoice -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Total Invoice</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_invoice'] }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Tagihan -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Tagihan Lunas</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2"> {{ $stats['tagihan_lunas'] }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-600 font-semibold">Lunas: {{ $stats['tagihan_lunas']}}</span>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-580 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Tagihan Belum Lunas</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2"> {{ $stats['tagihan_pending'] }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-red-600 font-semibold">Lunas: {{ $stats['tagihan_pending']}}</span>
                    </div>
                </div>

                <!-- Total Dokumen -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Total Dokumen</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_dokumen'] }}</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-red-800 to-red-900 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Daftar Perkara</h2>
                </div>

                @if($client->perkara->isEmpty())
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada data perkara</p>
                    </div>
                @else
                    <div class="p-6 space-y-4">
                        @foreach($client->perkara as $perkara)
                            <div class="border border-gray-200 rounded-xl overflow-hidden transition-all duration-200 hover:shadow-md" 
                                 x-data="{ expanded: false }">
                                
                                {{-- === HEADER (SELALU MUNCUL - KECIL) === --}}
                                <div class="bg-white p-4 cursor-pointer hover:bg-gray-50 transition-colors flex justify-between items-center"
                                     @click="expanded = !expanded">
                                    
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0">
                                            @if($perkara->status == 'berjalan')
                                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                                                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100">
                                                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>

                                        <div>
                                            <h3 class="text-lg font-bold text-gray-800">{{ $perkara->judul_perkara }}</h3>
                                            <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                                                <span class="px-2 py-0.5 rounded-md text-xs font-medium border {{ $perkara->status == 'berjalan' ? 'border-green-200 bg-green-50 text-green-700' : 'border-gray-200 bg-gray-50 text-gray-600' }}">
                                                    {{ ucfirst($perkara->status) }}
                                                </span>
                                                <span>•</span>
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    {{ \Carbon\Carbon::parse($perkara->tanggal_mulai)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-gray-400 transform transition-transform duration-200"
                                         :class="{'rotate-180': expanded}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                {{-- === END HEADER === --}}


                                {{-- === BODY (MUNCUL SAAT DI-KLIK) === --}}
                                <div x-show="expanded" 
                                     x-cloak 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="bg-gray-50 border-t border-gray-100 p-6">
                                    
                                    <div class="mb-6">
                                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi Perkara</h4>
                                        <p class="text-gray-700 leading-relaxed mb-2">{{ $perkara->deskripsi }}</p>
                                        <div class="text-sm text-gray-500">
                                            <span class="font-medium">Jenis Perkara:</span> {{ ucfirst($perkara->jenis_perkara) }}
                                        </div>
                                    </div>

                                    <div class="mb-6 bg-white rounded-lg border border-gray-200 p-4">
                                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Dokumen Legal</h4>
                                        
                                        @if($perkara->suratKuasa)
                                            <div class="flex items-center justify-between p-3 rounded-lg bg-red-50 border border-red-100">
                                                <div class="flex items-center gap-3">
                                                    <div class="bg-white p-2 rounded-md shadow-sm text-red-600">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-bold text-gray-900">Surat Kuasa</p>
                                                        <p class="text-xs text-gray-600">
                                                            No: {{ $perkara->suratKuasa->nomor_surat ?? '-' }} • {{ \Carbon\Carbon::parse($perkara->suratKuasa->tanggal_surat)->format('d M Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <a href="{{ Storage::url($perkara->suratKuasa->file_path) }}" 
                                                   download
                                                   target="_blank"
                                                   class="px-3 py-2 bg-white text-red-600 text-sm font-semibold rounded shadow-sm border border-red-200 hover:bg-red-50 transition-colors flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    Unduh
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-400 italic text-center p-3 border border-dashed border-gray-300 rounded-lg">
                                                Belum ada Surat Kuasa yang diunggah
                                            </div>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <button @click="openProgressModal({{ $perkara->id }}, '{{ $perkara->judul_perkara }}')" 
                                                class="flex justify-center items-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-sm font-medium">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            Progress ({{ $perkara->progres->count() }})
                                        </button>

                                        <button @click="openInvoiceModal({{ $perkara->id }}, '{{ $perkara->judul_perkara }}')" 
                                                class="flex justify-center items-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-sm font-medium">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                                            </svg>
                                            Invoice ({{ $perkara->invoices->count() }})
                                        </button>

                                        <button @click="openDocumentModal({{ $perkara->id }}, '{{ $perkara->judul_perkara }}')" 
                                                class="flex justify-center items-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all shadow-sm font-medium">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            Dokumen ({{ $perkara->documents->count() }})
                                        </button>
                                    </div>

                                </div>
                                {{-- === END BODY === --}}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div x-show="showProgressModal" 
                 x-cloak
                 class="fixed inset-0 z-50 overflow-y-auto" 
                 style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 bg-black opacity-50" @click="showProgressModal = false"></div>
                    
                    <div class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[80vh] overflow-hidden">
                        <div class="bg-red-800 px-6 py-4 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-white">Progress Perkara: <span x-text="selectedPerkaraTitle"></span></h3>
                            <button @click="showProgressModal = false" class="text-white hover:text-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="p-6 overflow-y-auto max-h-[60vh]">
                            <div x-show="loading" class="text-center py-12">
                                <svg class="animate-spin h-12 w-12 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="text-gray-600 mt-4">Memuat data...</p>
                            </div>

                            <div x-show="!loading && progressList.length === 0" class="text-center py-12">
                                <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500">Belum ada progress</p>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(progress, index) in progressList" :key="index">
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-semibold text-gray-800" x-text="progress.judul_progres"></h4>
                                            <span class="text-sm text-gray-500" x-text="formatDate(progress.tanggal_progres)"></span>
                                        </div>
                                        <p class="text-gray-600 text-sm" x-text="progress.deskripsi_progres"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="showInvoiceModal" 
                 x-cloak
                 class="fixed inset-0 z-50 overflow-y-auto" 
                 style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 bg-black opacity-50" @click="showInvoiceModal = false"></div>
                    
                    <div class="relative bg-white rounded-xl shadow-2xl max-w-5xl w-full max-h-[80vh] overflow-hidden">
                        <div class="bg-red-800 px-6 py-4 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-white">Invoice Perkara: <span x-text="selectedPerkaraTitle"></span></h3>
                            <button @click="showInvoiceModal = false" class="text-white hover:text-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="p-6 overflow-y-auto max-h-[60vh]">
                            <div x-show="loading" class="text-center py-12">
                                <svg class="animate-spin h-12 w-12 text-purple-600 mx-auto" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="text-gray-600 mt-4">Memuat data...</p>
                            </div>

                            <div x-show="!loading && invoiceList.length === 0" class="text-center py-12">
                                <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                                </svg>
                                <p class="text-gray-500">Belum ada invoice</p>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(invoice, index) in invoiceList" :key="index">
                                    <div class="border border-purple-200 rounded-xl p-5 hover:shadow-lg transition-all bg-gradient-to-r from-purple-50 to-white">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-3">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-600 text-white">
                                                        Progres #<span x-text="invoice.urutan || '-'"></span>
                                                    </span>
                                                </div>
                                                
                                                <h4 class="text-lg font-bold text-gray-900 mb-2" x-text="invoice.judul_progres || 'Tanpa Judul'"></h4>
                                                
                                                <div class="flex items-center gap-3 mb-2">
                                                    <span class="text-sm font-semibold text-gray-600">Status Invoice:</span>
                                                    <span :class="{
                                                        'bg-green-100 text-green-800 border border-green-300': invoice.status === 'lunas',
                                                        'bg-yellow-100 text-yellow-800 border border-yellow-300': invoice.status === 'pending',
                                                        'bg-red-100 text-red-800 border border-red-300': invoice.status === 'tertunda'
                                                    }" class="px-3 py-1 rounded-full text-xs font-bold" x-text="invoice.status.toUpperCase()"></span>
                                                </div>
                                            </div>
                                            
                                            <a :href="`{{ route('user.clients.download.invoice', [$client->id, ':perkaraId', ':invoiceId']) }}`.replace(':perkaraId', selectedPerkaraId).replace(':invoiceId', invoice.id)" 
                                               class="inline-flex items-center px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="showDocumentModal" 
                 x-cloak
                 class="fixed inset-0 z-50 overflow-y-auto" 
                 style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 bg-black opacity-50" @click="showDocumentModal = false"></div>
                    
                    <div class="relative bg-white rounded-xl shadow-2xl max-w-5xl w-full max-h-[80vh] overflow-hidden">
                        <div class="bg-red-800 px-6 py-4 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-white">Dokumen Perkara: <span x-text="selectedPerkaraTitle"></span></h3>
                            <button @click="showDocumentModal = false" class="text-white hover:text-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="p-6 overflow-y-auto max-h-[60vh]">
                            <div x-show="loading" class="text-center py-12">
                                <svg class="animate-spin h-12 w-12 text-green-600 mx-auto" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="text-gray-600 mt-4">Memuat data...</p>
                            </div>

                            <div x-show="!loading && documentList.length === 0" class="text-center py-12">
                                <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-gray-500">Belum ada dokumen</p>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(doc, index) in documentList" :key="index">
                                    <div class="border border-green-200 rounded-xl p-5 hover:shadow-lg transition-all bg-gradient-to-r from-green-50 to-white">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="flex items-start flex-1 gap-4">
                                                <div class="bg-green-100 p-3 rounded-lg flex-shrink-0">
                                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-600 text-white">
                                                            Progres #<span x-text="doc.urutan || '-'"></span>
                                                        </span>
                                                    </div>
                                                    
                                                    <h4 class="text-lg font-bold text-gray-900 mb-2" x-text="doc.judul_progres || 'Tanpa Judul'"></h4>
                                                    
                                                    <p class="text-sm font-semibold text-gray-700 mb-1">
                                                        📄 <span x-text="doc.file_name || getFileName(doc.file_path)"></span>
                                                    </p>
                                                    
                                                    <p class="text-xs text-gray-500">
                                                        Upload: <span x-text="formatDate(doc.created_at)"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <a :href="`{{ route('user.clients.download.document', [$client->id, ':perkaraId', ':documentId']) }}`.replace(':perkaraId', selectedPerkaraId).replace(':documentId', doc.id)" 
                                               class="inline-flex items-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex-shrink-0">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function clientPortal() {
                    return {
                        showProgressModal: false,
                        showInvoiceModal: false,
                        showDocumentModal: false,
                        loading: false,
                        selectedPerkaraId: null,
                        selectedPerkaraTitle: '',
                        progressList: [],
                        invoiceList: [],
                        documentList: [],
            
                        openProgressModal(perkaraId, perkaraTitle) {
                            this.selectedPerkaraId = perkaraId;
                            this.selectedPerkaraTitle = perkaraTitle;
                            this.showProgressModal = true;
                            this.loadProgress(perkaraId);
                        },
                        
                        getFileName(filePath) {
                            if (!filePath) return 'Dokumen';
                            const parts = filePath.split('/');
                            return parts[parts.length - 1];
                        },
            
                        openInvoiceModal(perkaraId, perkaraTitle) {
                            this.selectedPerkaraId = perkaraId;
                            this.selectedPerkaraTitle = perkaraTitle;
                            this.showInvoiceModal = true;
                            this.loadInvoices(perkaraId);
                        },
            
                        openDocumentModal(perkaraId, perkaraTitle) {
                            this.selectedPerkaraId = perkaraId;
                            this.selectedPerkaraTitle = perkaraTitle;
                            this.showDocumentModal = true;
                            this.loadDocuments(perkaraId);
                        },
            
                        async loadProgress(perkaraId) {
                            this.loading = true;
                            try {
                                const response = await fetch(`/user/clients/{{ $client->id }}/perkara/${perkaraId}/progress`);
                                const data = await response.json();
                                this.progressList = data.progress || [];
                            } catch (error) {
                                console.error('Error loading progress:', error);
                                alert('Gagal memuat data progress');
                            } finally {
                                this.loading = false;
                            }
                        },
            
                        async loadInvoices(perkaraId) {
                            this.loading = true;
                            try {
                                const response = await fetch(`/user/clients/{{ $client->id }}/perkara/${perkaraId}/invoices`);
                                const data = await response.json();
                                this.invoiceList = data.invoices || [];
                            } catch (error) {
                                console.error('Error loading invoices:', error);
                                alert('Gagal memuat data invoice');
                            } finally {
                                this.loading = false;
                            }
                        },
            
                        async loadDocuments(perkaraId) {
                            this.loading = true;
                            try {
                                const response = await fetch(`/user/clients/{{ $client->id }}/perkara/${perkaraId}/documents`);
                                const data = await response.json();
                                this.documentList = data.documents || [];
                            } catch (error) {
                                console.error('Error loading documents:', error);
                                alert('Gagal memuat data dokumen');
                            } finally {
                                this.loading = false;
                            }
                        },
            
                        formatDate(date) {
                            if (!date) return '-';
                            const d = new Date(date);
                            const options = { year: 'numeric', month: 'long', day: 'numeric' };
                            return d.toLocaleDateString('id-ID', options);
                        },
            
                        formatCurrency(amount) {
                            if (!amount) return 'Rp 0';
                            return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
                        }
                    }
                }
            </script>
            
            <style>
                [x-cloak] { display: none !important; }
            </style>
</x-layout>
<x-layout>
    <!-- CSRF Token untuk AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('admin.clients.show', $client->id) }}" 
                           class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-2 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali ke Client
                        </a>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Perkara</h1>
                        <p class="mt-1 text-sm text-gray-600">Informasi lengkap dan progres perkara</p>
                    </div>
                    <div class="flex gap-3">
                        @if($perkara->status === 'berjalan')
                            <button 
                                onclick="document.getElementById('modal-selesai').classList.remove('hidden')"
                                class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Selesaikan Perkara
                            </button>
                            <a href="{{ route('admin.progres.create', ['client' => $client->id, 'perkara' => $perkara->id]) }}" 
                                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                 <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                 </svg>
                                 Tambah Progres
                             </a>
                        @else
                            <button 
                                onclick="document.getElementById('modal-reopen').classList.remove('hidden')"
                                class="inline-flex items-center px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Buka Kembali Perkara
                            </button>
                        @endif
                    </div>
                </div>
            </div>
    
            @if($perkara->status === 'selesai')
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-green-800 font-semibold">Perkara Telah Selesai</p>
                            <p class="text-green-700 text-sm">Perkara ini telah ditandai sebagai selesai.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Informasi Perkara Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
                <div class="bg-red-800 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Informasi Perkara
                    </h2>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Jenis Perkara</label>
                            <p class="text-lg font-semibold text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $perkara->jenis_perkara }}
                            </p>
                        </div>
    
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Status</label>
                            <div class="flex items-center">
                                @php
                                    $statusConfig = [
                                        'berjalan' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => '⏳'],
                                        'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => '✓'],
                                    ];
                                    $config = $statusConfig[$perkara->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => '•'];
                                @endphp
                                <span class="inline-flex items-center px-4 py-3 rounded-lg font-semibold text-sm {{ $config['bg'] }} {{ $config['text'] }}">
                                    <span class="mr-2">{{ $config['icon'] }}</span>
                                    {{ ucfirst($perkara->status) }}
                                </span>
                            </div>
                        </div>
    
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Tanggal Mulai</label>
                            <p class="text-lg font-semibold text-gray-900 bg-gray-50 px-4 py-3 rounded-lg flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($perkara->tanggal_mulai)->format('d M Y') }}
                            </p>
                        </div>
    
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Client</label>
                            <p class="text-lg font-semibold text-gray-900 bg-gray-50 px-4 py-3 rounded-lg flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $client->nama_lengkap }}
                            </p>
                        </div>
                    </div>
    
                    <div class="mt-6 space-y-2">
                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Deskripsi Perkara</label>
                        <div class="bg-gray-50 px-6 py-4 rounded-lg border-l-4 border-red-800">
                            <p class="text-gray-700 leading-relaxed">{{ $perkara->deskripsi_perkara }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-red-800 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Progres Perkara
                    </h2>
                </div>
            
                <div class="p-8">
                    @forelse($perkara->progres->sortBy('urutan') as $progres)
                        <div class="mb-6 last:mb-0">
                            <div class="flex">
                                <div class="flex flex-col items-center mr-6">
                                    <div class="w-12 h-12 bg-red-800 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ $progres->urutan }}
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-1 h-full bg-red-800 mt-2"></div>
                                    @endif
                                </div>
            
                                <div class="flex-1 bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 shadow-md border border-gray-200 mb-4">
                                    
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $progres->judul_progres }}</h3>
                                            <p class="text-sm text-gray-600 flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($progres->tanggal_progres)->format('d M Y') }}
                                            </p>
                                        </div>
            
                                        <a href="{{  route('admin.progres.edit',['perkara' => $perkara, 'client' => $client, 'progres' => $progres])}}" class="ml-4 p-2 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all shadow-sm border border-transparent hover:border-yellow-200" title="Edit Progres">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        </div>
            
                                    @if($progres->keterangan)
                                        <div class="mb-4 p-4 bg-white rounded-lg border-l-4 border-green-500">
                                            <p class="text-gray-700">{{ $progres->keterangan }}</p>
                                        </div>
                                    @endif
            
                                    @if($progres->dokumen->count() > 0)
                                        <div class="mb-4">
                                            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                Dokumen ({{ $progres->dokumen->count() }})
                                            </h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                @foreach($progres->dokumen as $dokumen)
                                                    <a href="{{ Storage::url($dokumen->file_path) }}" 
                                                       target="_blank"
                                                       class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-200 group">
                                                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700 truncate">
                                                            {{ basename($dokumen->file_path) }}
                                                        </span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
            
                                    @if($progres->invoice->isNotEmpty())
                                        @foreach($progres->invoice as $inv)
                                            <div class="flex items-center gap-3 mb-2">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input 
                                                        type="checkbox" 
                                                        class="sr-only peer invoice-toggle" 
                                                        data-invoice-id="{{ $inv->id }}"
                                                        {{ $inv->status === 'lunas' ? 'checked' : '' }}>
                                                    <div class="w-14 h-7 bg-red-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500"></div>
                                                </label>
                                                <span class="invoice-status-text text-sm font-semibold transition-colors {{ $inv->status === 'lunas' ? 'text-green-700' : 'text-red-700' }}">
                                                    {{ $inv->status === 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                                                </span>
                                            </div>
                                            
                                            <a href="{{ route('admin.progres.download', $inv->id) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Download Invoice
                                            </a>
                                        @endforeach
                                    @endif
            
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Progres</h3>
                            <p class="text-gray-500 mb-6">Mulai tambahkan progres untuk perkara ini</p>
                            <a href="{{ route('admin.progres.create', ['client' => $client->id, 'perkara' => $perkara->id]) }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Progres Pertama
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
    
        </div>
    </div>

    <!-- Modals -->
    <div id="modal-selesai" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 mx-auto bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">
                    Selesaikan Perkara?
                </h3>
                <p class="text-gray-600 text-center mb-6">
                    Apakah Anda yakin ingin menandai perkara ini sebagai selesai? Status perkara akan diubah menjadi "Selesai".
                </p>
                
                <form action="{{ route('admin.perkara.finish', ['client' => $client->id, 'perkara' => $perkara->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="flex gap-3">
                        <button 
                            type="button"
                            onclick="document.getElementById('modal-selesai').classList.add('hidden')"
                            class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="flex-1 px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all">
                            Ya, Selesaikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-reopen" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 mx-auto bg-yellow-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">
                    Reopen Perkara?
                </h3>
                <p class="text-gray-600 text-center mb-6">
                    Apakah Anda yakin ingin reopen perkara ini dan menandai perkara ini sebagai berjalan?
                </p>
                
                <form action="{{ route('admin.perkara.reopen', ['client' => $client->id, 'perkara' => $perkara->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="flex gap-3">
                        <button 
                            type="button"
                            onclick="document.getElementById('modal-reopen').classList.add('hidden')"
                            class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="flex-1 px-4 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all">
                            Ya, Reopen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const invoiceToggles = document.querySelectorAll('.invoice-toggle');
        
        invoiceToggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const invoiceId = this.getAttribute('data-invoice-id');
                const isChecked = this.checked;
                const statusText = this.closest('.flex').querySelector('.invoice-status-text');
                
                this.disabled = true;
                const originalText = statusText.textContent;
                statusText.textContent = 'Updating...';
                
                fetch(`/admin/progres/${invoiceId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === 'lunas') {
                            statusText.textContent = 'Lunas';
                            statusText.classList.remove('text-red-700');
                            statusText.classList.add('text-green-700');
                            this.checked = true;
                        } else {
                            statusText.textContent = 'Belum Bayar';
                            statusText.classList.remove('text-green-700');
                            statusText.classList.add('text-red-700');
                            this.checked = false;
                        }
                        showNotification(data.message, 'success');
                    } else {
                        this.checked = !isChecked;
                        statusText.textContent = originalText;
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isChecked;
                    statusText.textContent = originalText;
                    showNotification('Terjadi kesalahan saat mengubah status', 'error');
                })
                .finally(() => {
                    this.disabled = false;
                });
            });
        });
        
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white font-semibold`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 10);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    });
    </script>
</x-layout>
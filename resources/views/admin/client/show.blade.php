<x-layout>
    <header class="bg-white shadow-lg rounded-lg mb-6 p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        {{-- Card Jumlah Client --}}
        <div class="bg-red-800 text-white shadow-xl rounded-xl p-6 hover:shadow-2xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Jumlah Perkara</p>
                    <h2 class="text-4xl font-bold">{{ $countClients }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        {{-- Card Perkara Berjalan --}}
        <div class="bg-red-800 text-white shadow-xl rounded-xl p-6 hover:shadow-2xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium mb-1">Perkara Berjalan</p>
                    <h2 class="text-4xl font-bold">{{ $perkaraBerjalan ?? 0 }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        {{-- Card Perkara Selesai --}}
        <div class="bg-red-800 text-white shadow-xl rounded-xl p-6 hover:shadow-2xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Perkara Selesai</p>
                    <h2 class="text-4xl font-bold">{{ $perkaraSelesai ?? 0 }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        {{-- Card User Info --}}
        <div class="bg-red-800 text-white shadow-xl rounded-xl p-6 hover:shadow-2xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Admin</p>
                    <h2 class="text-lg font-bold truncate">{{ Auth::user()->name }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-4 items-center justify-between pt-4 border-t border-gray-200">
        <div class="flex gap-3">
            <a href="{{ route('admin.perkara.create', $client) }}" 
               class="inline-flex items-center px-6 py-3 bg-red-800 text-white font-semibold rounded-lg shadow-md hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Perkara
            </a>
        </div>
        <div class="text-sm text-gray-500">
            <span class="font-medium">Last Updated:</span> {{ now()->format('d M Y, H:i') }}
        </div>
    </div>
</header>
    <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6 mb-6 p-4">
        {{-- Kiri - Data Client --}}
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-red-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white">Data Client</h1>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Nama Lengkap
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    No. Telepon
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Alamat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Perusahaan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Jenis Client
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($client)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $client->nama_lengkap }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $client->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $client->no_hp }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $client->alamat }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $client->nama_perusahaan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $client->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $client->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $client->jenis_client }}
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="mt-2 text-sm font-medium">Data client tidak tersedia</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       {{-- Kanan - Daftar Perkara --}}
       <div class="w-full">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col h-full">
            <div class="bg-red-800 px-6 py-4 shrink-0">
                <h1 class="text-2xl font-bold text-white">Daftar Perkara</h1>
            </div>
            
            {{-- Container List --}}
            <div class="p-4 flex-1 overflow-y-auto">
                {{-- PERBAIKAN DISINI: Gunakan count() > 0 --}}
                @if(isset($perkara) && $perkara->count() > 0)
                    <div class="space-y-3">
                        {{-- Loop pagination variable --}}
                        @foreach ($perkara as $index => $item)
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            {{-- Header Card --}}
                            <button 
                                type="button"
                                onclick="togglePerkara({{ $index }})"
                                class="w-full bg-gray-50 hover:bg-gray-100 px-4 py-3 flex items-center justify-between transition-colors">
                                <div class="flex items-center gap-3">
                                    <svg id="icon-{{ $index }}" class="w-5 h-5 text-gray-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <div class="text-left">
                                        <h3 class="text-sm font-semibold text-gray-900">{{ $item->jenis_perkara }}</h3>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->status == 'berjalan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->status }}
                                </span>
                            </button>
    
                            {{-- Detail Content --}}
                            <div id="content-{{ $index }}" class="hidden bg-white border-t border-gray-200">
                                <div class="p-4 space-y-4">
                                    <div>
                                        <h4 class="text-xs font-semibold text-gray-700 mb-1">Deskripsi Perkara</h4>
                                        <p class="text-sm text-gray-600">{{ $item->deskripsi_perkara }}</p>
                                    </div>
    
                                    <div class="grid grid-cols-2 gap-3 text-xs">
                                        <div>
                                            <span class="text-gray-500">Tanggal Mulai:</span>
                                            <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Status:</span>
                                            <p class="font-medium text-gray-900">{{ $item->status }}</p>
                                        </div>
                                    </div>
    
                                    {{-- Surat Kuasa --}}
                                    <div class="pt-2 border-t border-gray-100">
                                        <h4 class="text-xs font-semibold text-gray-700 mb-2">Dokumen Surat Kuasa</h4>
                                        @if($item->suratKuasa)
                                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded border border-gray-100">
                                                <div class="flex flex-col">
                                                    <span class="text-xs text-gray-500">Nomor Surat:</span>
                                                    <span class="text-xs font-medium text-gray-900">{{ $item->suratKuasa->nomor_surat ?? '-' }}</span>
                                                </div>
                                                <a href="{{ Storage::url($item->suratKuasa->file_path) }}" 
                                                   download
                                                   class="inline-flex items-center px-2 py-1 bg-white border border-gray-300 rounded text-xs text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                    </svg>
                                                    Unduh
                                                </a>
                                            </div>
                                        @else
                                            <p class="text-xs text-gray-400 italic">Tidak ada file surat kuasa.</p>
                                        @endif
                                    </div>
    
                                    {{-- Actions --}}
                                    <div class="flex gap-2 pt-2 border-t border-gray-100">
                                        @if($item->status === 'berjalan')
                                        <a href="{{ route('admin.perkara.edit', ['perkara' => $item, 'client' => $client]) }}" 
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-colors">
                                             <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                             </svg>
                                             Edit
                                        </a>
                                        <a href="{{ route('admin.progres.create', ['perkara' => $item, 'client' => $client]) }}" 
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors">
                                             <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                             </svg>
                                             Progres
                                        </a>
                                        @endif
                                        
                                        <a href="{{ route('admin.perkara.show', ['client' => $client, 'perkara' => $item]) }}" 
                                           class="{{ $item->status === 'selesai' ? 'w-full' : 'flex-1' }} inline-flex items-center justify-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-gray-500">
                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm font-medium">Belum ada data perkara</p>
                    </div>
                @endif
            </div>

            {{-- Pagination Links Section --}}
            @if(isset($perkara) && $perkara->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 shrink-0">
                {{ $perkara->links() }}
            </div>
            @endif
        </div>
    </div>
    <script>
        function togglePerkara(index) {
            const content = document.getElementById(`content-${index}`);
            const icon = document.getElementById(`icon-${index}`);
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(90deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</x-layout>
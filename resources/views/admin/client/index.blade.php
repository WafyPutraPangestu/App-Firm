<x-layout>
    <div x-data="{ 
        deleteModalOpen: false, 
        deleteAction: '',
        keyModalOpen: false,
        keyAction: ''
    }">

    <div class="bg-gradient-to-br from-red-900 via-red-800 to-red-900 text-white mb-6 relative z-0">
        <div class="px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Client Management</h1>
                        <p class="text-red-100">Kelola data client dan monitoring statistik</p>
                    </div>
                    <a href="{{ route('admin.clients.create') }}"
                        class="mt-4 md:mt-0 group relative px-6 py-3 bg-white text-red-800 font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Create New Client
                        </span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-100 to-red-200 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                     <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Total Client</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <p class="text-3xl font-bold">{{ $stats['aktif'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Aktif</p>
                    </div>
                     <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <p class="text-3xl font-bold">{{ $stats['retainer'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Retainer</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <p class="text-3xl font-bold">{{ $stats['litigasi'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Litigasi</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <p class="text-3xl font-bold">{{ $stats['non_litigasi'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Non Litigasi</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <p class="text-3xl font-bold">{{ $stats['total_perkara'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Total Perkara</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8 pb-10">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 relative z-0">
            <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Daftar Client</h2>
                <p class="text-sm text-gray-600 mt-1">Total {{ $stats['total'] }} client terdaftar</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-red-800 to-red-900 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Company</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($user->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center text-gray-500">
                                    Tidak Ada Data Client
                                </td>
                            </tr>
                        @else
                            @foreach ($user as $client)
                                <tr class="hover:bg-red-50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-800 font-semibold text-sm group-hover:bg-red-200">
                                            {{ $client->id }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-red-800 to-red-900 rounded-full flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($client->nama_lengkap, 0, 2)) }}
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-semibold text-gray-900">{{ $client->nama_lengkap }}</p>
                                                @if($client->admin)
                                                    <p class="text-xs text-gray-500">by {{ $client->admin->name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-sm text-gray-900">{{ $client->nama_perusahaan }}</p>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600 space-y-1">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                {{ $client->email }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                {{ $client->no_hp }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            @if($client->jenis_client == 'retainer') bg-purple-100 text-purple-800 border border-purple-200
                                            @elseif($client->jenis_client == 'litigasi') bg-blue-100 text-blue-800 border border-blue-200
                                            @else bg-green-100 text-green-800 border border-green-200
                                            @endif">
                                            {{ str_replace('_', ' ', ucfirst($client->jenis_client)) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div x-data="statusUpdater({{ $client->id }}, '{{ $client->status }}')">
                                            <div class="relative w-32 mx-auto">
                                                <div x-show="isLoading" class="absolute inset-0 flex items-center justify-center bg-white/80 z-20 rounded-full" style="display: none;">
                                                    <svg class="animate-spin h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </div>
                                                <select 
                                                    x-model="status" 
                                                    @change="changeStatus($event)"
                                                    :class="status === 'aktif' ? 'bg-green-100 text-green-800 border-green-300' : 'bg-red-100 text-red-800 border-red-300'"
                                                    class="block w-full pl-3 pr-8 py-1.5 text-xs font-semibold rounded-full border-2 focus:ring-2 focus:ring-offset-1 transition-all duration-300 shadow-sm outline-none">
                                                    <option value="aktif">Aktif</option>
                                                    <option value="nonaktif">Non-Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button" 
                                                @click="keyModalOpen = true; keyAction = '{{ route('admin.clients.generateKey', $client) }}'"
                                                class="p-2 bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-lg transition-all hover:scale-105" title="Generate Key">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                            </button>
                                            
                                            <a href="{{ Route('admin.clients.show', $client) }}"
                                               class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-all hover:scale-105" title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>

                                            <a href="{{ route('admin.clients.edit', $client) }}"
                                               class="p-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded-lg transition-all hover:scale-105" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>

                                            <button type="button"
                                                @click="deleteModalOpen = true; deleteAction = '{{ route('admin.clients.destroy', $client) }}'"
                                                class="p-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-all hover:scale-105" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
             <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $user->links() }}
            </div>
        </div>
    </div>

    <div x-show="deleteModalOpen" 
         x-transition.opacity.duration.300ms
         class="fixed inset-0 z-[60] overflow-y-auto" 
         style="display: none;">
        
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="deleteModalOpen = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="deleteModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Hapus Data Client</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah anda yakin? Data ini akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <form :action="deleteAction" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Ya, Hapus
                        </button>
                    </form>
                    <button type="button" @click="deleteModalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="keyModalOpen" 
         x-transition.opacity.duration.300ms
         class="fixed inset-0 z-[60] overflow-y-auto" 
         style="display: none;">
        
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="keyModalOpen = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="keyModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Generate Client Key Baru?</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Key lama akan dihapus dan diganti. Pastikan client sudah diberitahu.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <form :action="keyAction" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 sm:ml-3 sm:w-auto">
                            Generate
                        </button>
                    </form>
                    <button type="button" @click="keyModalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    </div> <script>
        function statusUpdater(id, initialStatus) {
            return {
                status: initialStatus,
                isLoading: false,
                changeStatus(e) {
                    this.isLoading = true;
                    const newStatus = e.target.value;
     
                    fetch(`/api/clients/${id}/update-status`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ status: newStatus })
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(data => {
                        this.status = data.status;
                    })
                    .catch(err => {
                        console.error('Error updating status:', err);
                        alert('Gagal mengubah status. Silakan coba lagi.');
                        // Kembalikan ke status awal jika gagal (opsional, tapi disarankan)
                        e.target.value = this.status;
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
                }
            }
        }
    </script>
</x-layout>
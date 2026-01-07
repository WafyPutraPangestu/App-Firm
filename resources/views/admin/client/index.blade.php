<x-layout>
    <!-- Hero Section with Stats -->
    <div class="bg-gradient-to-br from-red-900 via-red-800 to-red-900 text-white mb-6">
        <div class="px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
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

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Total Clients -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Total Client</p>
                    </div>

                    <!-- Active -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold">{{ $stats['aktif'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Aktif</p>
                    </div>

                    <!-- Retainer -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold">{{ $stats['retainer'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Retainer</p>
                    </div>

                    <!-- Litigasi -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold">{{ $stats['litigasi'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Litigasi</p>
                    </div>

                    <!-- Non Litigasi -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold">{{ $stats['non_litigasi'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Non Litigasi</p>
                    </div>

                    <!-- Total Perkara -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold">{{ $stats['total_perkara'] }}</p>
                        <p class="text-red-100 text-sm mt-1">Total Perkara</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Daftar Client</h2>
                <p class="text-sm text-gray-600 mt-1">Total {{ $stats['total'] }} client terdaftar</p>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-red-800 to-red-900 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Company</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Phone</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($user->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <p class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada Data Client</p>
                                    <p class="text-sm text-gray-500">Silakan tambahkan data client baru</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($user as $client)
                                <tr class="hover:bg-red-50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-800 font-semibold text-sm group-hover:bg-red-200 transition-colors">
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
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $client->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $client->no_hp }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            @if($client->jenis_client == 'retainer') bg-purple-100 text-purple-800 border border-purple-200
                                            @elseif($client->jenis_client == 'litigasi') bg-blue-100 text-blue-800 border border-blue-200
                                            @else bg-green-100 text-green-800 border border-green-200
                                            @endif">
                                            @if($client->jenis_client == 'retainer')
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                                </svg>
                                            @elseif($client->jenis_client == 'litigasi')
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            @endif
                                            {{ str_replace('_', ' ', ucfirst($client->jenis_client)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div x-data="statusUpdater({{ $client->id }}, '{{ $client->status }}')">
                                            <div class="relative">
                                                <div x-show="isLoading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-50 z-10 rounded-full">
                                                    <svg class="animate-spin h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </div>
                                                <select 
                                                    x-model="status" 
                                                    @change="changeStatus($event)"
                                                    :class="colorClass"
                                                    class="block w-full pl-3 pr-8 py-2 text-xs font-semibold rounded-full border-2 appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all duration-300 shadow-sm">
                                                    <option value="aktif">Aktif</option>
                                                    <option value="nonaktif">Non-Aktif</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Generate Key -->
                                            <form action="{{ route('admin.clients.generateKey', $client) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        onclick="return confirm('Apakah anda yakin ingin membuat Client Key baru? Key lama (jika ada) akan terhapus.')"
                                                        class="inline-flex items-center px-3 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 text-xs font-semibold rounded-lg transition-all transform hover:scale-105 shadow-sm hover:shadow-md"
                                                        title="Generate Client Key">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            <!-- View -->
                                            <a href="{{ Route('admin.clients.show', $client) }}"
                                               class="inline-flex items-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-semibold rounded-lg transition-all transform hover:scale-105 shadow-sm hover:shadow-md"
                                               title="View Details">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.clients.edit', $client) }}"
                                               class="inline-flex items-center px-3 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-xs font-semibold rounded-lg transition-all transform hover:scale-105 shadow-sm hover:shadow-md"
                                               title="Edit Client">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this client?')"
                                                        class="inline-flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold rounded-lg transition-all transform hover:scale-105 shadow-sm hover:shadow-md"
                                                        title="Delete Client">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $user->links() }}
            </div>
        </div>
    </div>

    <script>
        function statusUpdater(id, initialStatus) {
            return {
                status: initialStatus,
                isLoading: false,
    
                init() {
                    setInterval(() => {
                        if (!this.isLoading) {
                            this.checkStatus();
                        }
                    }, 5000);
                },
    
                checkStatus() {
                    fetch(`/api/clients/${id}/status?t=${new Date().getTime()}`)
                        .then(res => res.json())
                        .then(data => {
                            if (this.status !== data.status) {
                                this.status = data.status;
                            }
                        })
                        .catch(err => console.error(err));
                },
    
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
                        if (!res.ok) throw new Error('Gagal update');
                        return res.json();
                    })
                    .then(data => {
                        console.log('Status berhasil diubah jadi:', data.status);
                        this.status = data.status;
                    })
                    .catch(err => {
                        alert('Gagal mengubah status!');
                        this.checkStatus();
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
                },
    
                get colorClass() {
                    if (this.status === 'Aktif' || this.status === 'aktif') {
                        return 'bg-green-100 text-green-800 border-green-300 focus:ring-green-500 hover:bg-green-200';
                    } else {
                        return 'bg-red-100 text-red-800 border-red-300 focus:ring-red-500 hover:bg-red-200';
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes slide-down {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        tbody tr {
            animation: slide-down 0.3s ease-out;
        }
    </style>
</x-layout>
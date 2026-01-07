<x-layout>
    <!-- Hero Section with Gradient -->
    <div class="bg-gradient-to-br from-red-900 via-red-800 to-red-900 text-white">
        <div class="container mx-auto px-4 py-16">
            <div>
                <h1 class="text-5xl font-bold mb-4 animate-fade-in">Portal Client</h1>
                <p class="text-red-100 text-lg mb-6">Kelola dan akses data client dengan mudah dan aman</p>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm">Total Client</p>
                                <p class="text-3xl font-bold mt-1">{{ $stats['total'] }}</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm">Client Aktif</p>
                                <p class="text-3xl font-bold mt-1">{{ $stats['aktif'] }}</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm">Litigasi</p>
                                <p class="text-3xl font-bold mt-1">{{ $stats['litigasi'] }}</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm">Non Litigasi</p>
                                <p class="text-3xl font-bold mt-1">{{ $stats['non_litigasi'] }}</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm">Retainer</p>
                                <p class="text-3xl font-bold mt-1">{{ $stats['retainer'] }}</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-sm animate-slide-down">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6 shadow-sm animate-slide-down">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Client Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @forelse ($client as $c)
                <div class="group bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-red-300 cursor-pointer transform hover:-translate-y-1"
                     onclick="openLoginModal({{ $c->id }}, '{{ $c->nama_lengkap }}', '{{ $c->email }}')">
                    
                    <!-- Card Header with Gradient -->
                    <div class="bg-gradient-to-r from-red-800 to-red-900 p-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                        
                        <div class="relative flex justify-between items-start">
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-white mb-2">{{ $c->nama_lengkap }}</h2>
                                <p class="text-red-100 text-sm">{{ $c->nama_perusahaan }}</p>
                            </div>
                            
                            <!-- Status Badge -->
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $c->status == 'aktif' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                                {{ ucfirst($c->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <div class="space-y-3">
                            <!-- Email -->
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm">{{ $c->email }}</span>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-sm">{{ $c->no_hp }}</span>
                            </div>

                            <!-- Address -->
                            @if($c->alamat)
                            <div class="flex items-start text-gray-700">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-red-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm">{{ $c->alamat }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Footer Info -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <!-- Jenis Client Badge -->
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($c->jenis_client == 'retainer') bg-purple-100 text-purple-800
                                    @elseif($c->jenis_client == 'litigasi') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($c->jenis_client) }}
                                </span>
                                
                                @if($c->client_key_expired_at)
                                    <span class="text-xs text-gray-500">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($c->client_key_expired_at)->format('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Arrow Icon -->
                            <div class="bg-red-800 p-2 rounded-lg group-hover:bg-red-900 transition-colors">
                                <svg class="w-5 h-5 text-white transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </div>
                        </div>

                        @if($c->admin)
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Dibuat oleh: <span class="font-medium text-gray-700">{{ $c->admin->name }}</span>
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-12 text-center">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Data Client</h3>
                        <p class="text-gray-500">Belum ada client yang terdaftar dalam sistem</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $client->links() }}
        </div>
    </div>

    <!-- Modern Modal Login -->
    <div id="loginModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative mx-auto w-full max-w-md p-4 animate-scale-in">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Modal Header with Red Gradient -->
                <div class="bg-gradient-to-r from-red-800 to-red-900 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-1">Login Client</h3>
                            <p class="text-red-100 text-sm">Masukkan client key untuk melanjutkan</p>
                        </div>
                        <button onclick="closeLoginModal()" class="text-white/80 hover:text-white transition">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Client Info -->
                    <div class="mb-6 p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border border-red-200">
                        <div class="flex items-start space-x-3">
                            <div class="bg-red-800 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900" id="modalClientName"></h4>
                                <p class="text-sm text-gray-600 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span id="modalClientEmail"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Login Form -->
                    <form id="loginForm" onsubmit="handleLogin(event)">
                        <input type="hidden" id="clientId" value="">
                        
                        <div class="mb-6">
                            <label for="client_key" class="block text-gray-700 font-semibold mb-2">
                                Client Key <span class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="client_key" 
                                    name="client_key" 
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-800 focus:border-transparent transition"
                                    placeholder="Masukkan client key"
                                    required
                                >
                            </div>
                            <p id="errorMessage" class="text-red-600 text-sm mt-2 hidden flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="errorText"></span>
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <button 
                                type="button"
                                onclick="closeLoginModal()"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-xl transition transform hover:scale-105">
                                Batal
                            </button>
                            <button 
                                type="submit" 
                                id="loginButton"
                                class="flex-1 bg-gradient-to-r from-red-800 to-red-900 hover:from-red-900 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-xl transition transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slide-down {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes scale-in {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
        
        .animate-slide-down {
            animation: slide-down 0.3s ease-out;
        }
        
        .animate-scale-in {
            animation: scale-in 0.3s ease-out;
        }
    </style>

    <script>
        function openLoginModal(clientId, clientName, clientEmail) {
            document.getElementById('loginModal').classList.remove('hidden');
            document.getElementById('clientId').value = clientId;
            document.getElementById('modalClientName').textContent = clientName;
            document.getElementById('modalClientEmail').textContent = clientEmail;
            document.getElementById('client_key').value = '';
            document.getElementById('errorMessage').classList.add('hidden');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
        }

        async function handleLogin(event) {
            event.preventDefault();
            
            const clientId = document.getElementById('clientId').value;
            const clientKey = document.getElementById('client_key').value;
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            const loginButton = document.getElementById('loginButton');
            
            errorMessage.classList.add('hidden');
            loginButton.disabled = true;
            loginButton.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;
            
            try {
                const response = await fetch(`/user/clients/${clientId}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        client_key: clientKey
                    })
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    errorText.textContent = data.message;
                    errorMessage.classList.remove('hidden');
                }
            } catch (error) {
                errorText.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorMessage.classList.remove('hidden');
            } finally {
                loginButton.disabled = false;
                loginButton.textContent = 'Login';
            }
        }

        document.getElementById('loginModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeLoginModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeLoginModal();
            }
        });
    </script>
</x-layout>
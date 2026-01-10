<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-800 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Create New Client</h1>
                <p class="text-gray-600">Fill in the information below to add a new client to your system</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-red-800 to-red-900 px-8 py-6">
                    <h2 class="text-xl font-semibold text-white">Client Information</h2>
                    <p class="text-red-100 text-sm mt-1">Please provide accurate details</p>
                </div>

                <form action="{{ route('admin.clients.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    <!-- Full Name -->
                    <div class="group">
                        <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name
                            <span class="text-red-800">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                placeholder="Enter full name"
                                value="{{ old('nama_lengkap') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('nama_lengkap')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div class="group">
                        <label for="nama_perusahaan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Company Name
                            <span class="text-red-800">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                                class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                placeholder="Enter company name"
                                value="{{ old('nama_perusahaan') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        @error('nama_perusahaan')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Two Column Layout for Email & Phone -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address
                                <span class="text-red-800">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" name="email" id="email"
                                    class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                    placeholder="email@example.com"
                                    value="{{ old('email') }}">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('email')
                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="group">
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number
                                <span class="text-red-800">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="no_hp" id="no_hp"
                                    class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                    placeholder="+62 812 3456 7890"
                                    value="{{ old('no_hp') }}">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('no_hp')
                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="group">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                            Address
                            <span class="text-red-800">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="alamat" id="alamat"
                                class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                placeholder="Enter full address"
                                value="{{ old('alamat') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('alamat')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Client Type with Alpine.js -->
                    <div x-data="clientApp()" x-init="fetchClients()" class="relative group">
                        <label for="jenis_client" class="block text-sm font-semibold text-gray-700 mb-2">
                            Client Type
                            <span class="text-red-800">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="jenis_client" id="jenis_client" x-model="search"
                                @input.debounce.300ms="fetchClients" 
                                placeholder="Type: retainer / litigasi / non"
                                class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                autocomplete="off">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>

                        @error('jenis_client')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror

                        <!-- Dropdown hasil search -->
                        <ul x-show="clients.length > 0 && search !== ''" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            @click.outside="clients = []"
                            class="absolute z-10 w-full bg-white border-2 border-red-200 rounded-xl mt-2 shadow-xl max-h-60 overflow-auto">
                            <template x-for="client in uniqueJenisClient" :key="client">
                                <li @click="selectJenis(client)"
                                    class="px-4 py-3 cursor-pointer hover:bg-red-50 transition-colors capitalize border-b border-gray-100 last:border-b-0 flex items-center"
                                    x-text="client.replace('_',' ')">
                                </li>
                            </template>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="history.back()"
                            class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300 shadow-sm">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-semibold rounded-xl hover:from-red-900 hover:to-red-950 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Create Client</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Footer -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Fields marked with <span class="text-red-800 font-semibold">*</span> are required</p>
            </div>
        </div>
    </div>

    <script>
        function clientApp() {
            return {
                search: '',
                clients: [],

                fetchClients() {
                    if (this.search.trim() === '') {
                        this.clients = [];
                        return;
                    }

                    fetch(`/clients/search?q=${encodeURIComponent(this.search)}`)
                        .then(res => res.json())
                        .then(res => {
                            this.clients = res.data;
                        })
                        .catch(() => {
                            this.clients = [];
                        });
                },

                selectJenis(value) {
                    this.search = value;
                    this.clients = [];
                },

                get uniqueJenisClient() {
                    return [...new Set(this.clients.map(c => c.jenis_client))];
                }
            }
        }
    </script>
</x-layout>
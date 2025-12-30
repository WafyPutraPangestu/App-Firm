<x-layout>
    <div class="">
        <div class="">
            <h1 class="text-2xl font-bold mb-6">Create New Client</h1>
            <form action="{{ route('admin.clients.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('nama_lengkap') }}">
                    @error('nama_lengkap')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('nama_perusahaan') }}">
                    @error('nama_perusahaan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="no_hp" id="no_hp"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('no_hp') }}">
                    @error('no_hp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="alamat" id="alamat"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('alamat') }}">
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div x-data="clientApp()" x-init="fetchClients()" class="relative">
                    <label for="jenis_client" class="block text-sm font-medium text-gray-700">
                        Client Type
                    </label>

                    <input type="text" name="jenis_client" id="jenis_client" x-model="search"
                        @input.debounce.300ms="fetchClients" placeholder="ketik: retainer / litigasi / non"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">

                    <!-- Error Laravel -->
                    @error('jenis_client')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Dropdown hasil search -->
                    <ul x-show="clients.length > 0 && search !== ''" @click.outside="clients = []"
                        class="absolute z-10 w-full bg-white border rounded-md mt-1 shadow">
                        <template x-for="client in uniqueJenisClient" :key="client">
                            <li @click="selectJenis(client)"
                                class="px-4 py-2 cursor-pointer hover:bg-gray-100 capitalize"
                                x-text="client.replace('_',' ')"></li>
                        </template>
                    </ul>
                </div>

                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">Create
                        Client</button>
                </div>
            </form>
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

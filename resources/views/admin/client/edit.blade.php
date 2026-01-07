<x-layout>
    <div class="">
        <div class="">
            <h1 class="text-2xl font-bold mb-6">Edit Client: {{ $client->nama_lengkap }}</h1>
            
            {{-- Perubahan 1: Route update & Method PUT --}}
            <form action="{{ route('admin.clients.update', $client) }}" method="POST" class="space-y-4">
                @method('PUT')
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('nama_lengkap', $client->nama_lengkap) }}">
                    @error('nama_lengkap')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Perusahaan (Ditambahkan agar sama dengan Create) --}}
                <div>
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('nama_perusahaan', $client->nama_perusahaan) }}">
                    @error('nama_perusahaan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('email', $client->email) }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No HP --}}
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="no_hp" id="no_hp"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('no_hp', $client->no_hp) }}">
                    @error('no_hp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="alamat" id="alamat"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                        value="{{ old('alamat', $client->alamat) }}">
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis Client (Dengan Alpine JS) --}}
                {{-- Perubahan 2: Memasukkan value lama ke dalam fungsi clientApp() --}}
                <div x-data="clientApp('{{ old('jenis_client', $client->jenis_client) }}')" x-init="fetchClients()" class="relative">
                    <label for="jenis_client" class="block text-sm font-medium text-gray-700">
                        Client Type
                    </label>

                    {{-- x-model akan otomatis terisi karena kita passing value di x-data --}}
                    <input type="text" name="jenis_client" id="jenis_client" x-model="search"
                        @input.debounce.300ms="fetchClients" placeholder="ketik: retainer / litigasi / non"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">

                    @error('jenis_client')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <ul x-show="clients.length > 0 && search !== ''" @click.outside="clients = []"
                        class="absolute z-10 w-full bg-white border rounded-md mt-1 shadow" style="display: none;">
                        <template x-for="client in uniqueJenisClient" :key="client">
                            <li @click="selectJenis(client)"
                                class="px-4 py-2 cursor-pointer hover:bg-gray-100 capitalize"
                                x-text="client.replace('_',' ')"></li>
                        </template>
                    </ul>
                </div>

                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">
                        Update Client
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Perubahan 3: Menerima parameter initialValue agar input terisi otomatis
        function clientApp(initialValue = '') {
            return {
                search: initialValue, // Set nilai awal dari database/old input
                clients: [],

                fetchClients() {
                    // Jika search kosong, jangan fetch, tapi tetap biarkan input kosong
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
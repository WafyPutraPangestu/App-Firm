<x-layout>
    {{-- @dd($client) --}}
    <header>
        <div class="">
            <h1>Halaman Create</h1>
        </div>
        <h1>{{ $client }}</h1>
    </header>
    <div class="">
        <form action="{{ route('admin.perkara.store', $client) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="jenis_perkara" class="block text-sm font-medium text-gray-700">
                    Jenis Perkara <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="jenis_perkara" 
                    id="jenis_perkara"
                    value="{{ old('jenis_perkara') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
                @error('jenis_perkara')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="mb-4">
                <label for="deskripsi_perkara" class="block text-sm font-medium text-gray-700">
                    Deskripsi Perkara <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="deskripsi_perkara" 
                    id="deskripsi_perkara"
                    rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >{{ old('deskripsi_perkara') }}</textarea>
                @error('deskripsi_perkara')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Tanggal Mulai akan otomatis terisi saat submit -->
            <div class="mb-4">
                <p class="text-sm text-gray-600">
                    <strong>Catatan:</strong> Tanggal mulai akan otomatis tercatat pada saat perkara dibuat.
                </p>
            </div>
        
            <div class="flex justify-end space-x-3">
                <a 
                    href="{{ route('admin.clients.show', $client) }}" 
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                >
                    Batal
                </a>
                <button 
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                >
                    Simpan Perkara
                </button>
            </div>
        </form>
    </div>
</x-layout>

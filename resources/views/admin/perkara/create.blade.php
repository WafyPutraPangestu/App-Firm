<x-layout>
    <header>
        <div class="">
            <h1>Halaman Create Perkara & Surat Kuasa</h1>
        </div>
        <h1>Klien: {{ $client->name ?? 'Nama Client' }}</h1>
    </header>
    <div class="">
        <form action="{{ route('admin.perkara.store', $client) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Data Perkara</h2>
                
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
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >{{ old('deskripsi_perkara') }}</textarea>
                @error('deskripsi_perkara')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 mt-6">
                <h2 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Data Surat Kuasa</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nomor_surat" class="block text-sm font-medium text-gray-700">
                            Nomor Surat (Opsional)
                        </label>
                        <input 
                            type="text" 
                            name="nomor_surat" 
                            id="nomor_surat"
                            value="{{ old('nomor_surat') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                        @error('nomor_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_surat" class="block text-sm font-medium text-gray-700">
                            Tanggal Surat <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_surat" 
                            id="tanggal_surat"
                            value="{{ old('tanggal_surat', date('Y-m-d')) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        @error('tanggal_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="file_surat" class="block text-sm font-medium text-gray-700">
                        Upload File Surat Kuasa <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="file" 
                        name="file_surat" 
                        id="file_surat"
                        accept=".pdf,.jpg,.jpeg,.png"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maks: 2MB.</p>
                    @error('file_surat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
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
                    Simpan Perkara & Surat Kuasa
                </button>
            </div>
        </form>
    </div>
</x-layout>
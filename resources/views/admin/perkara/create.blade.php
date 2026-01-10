<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-800 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Create Perkara & Surat Kuasa</h1>
                <div class="flex items-center justify-center space-x-2 text-gray-600">
                    <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <p class="font-semibold">Client: <span class="text-red-800">{{ $client->name ?? 'Nama Client' }}</span></p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.perkara.store', $client) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Section 1: Data Perkara -->
                    <div class="bg-gradient-to-r from-red-800 to-red-900 px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            <h2 class="text-xl font-semibold text-white">Data Perkara</h2>
                        </div>
                        <p class="text-red-100 text-sm mt-1 ml-9">Detail informasi tentang perkara</p>
                    </div>

                    <div class="p-8 space-y-6">
                        <!-- Jenis Perkara -->
                        <div class="group">
                            <label for="jenis_perkara" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Perkara
                                <span class="text-red-800">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="jenis_perkara" 
                                    id="jenis_perkara"
                                    value="{{ old('jenis_perkara') }}"
                                    placeholder="Contoh: Perdata, Pidana, TUN, dll"
                                    class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('jenis_perkara')
                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Deskripsi Perkara -->
                        <div class="group">
                            <label for="deskripsi_perkara" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Perkara
                                <span class="text-red-800">*</span>
                            </label>
                            <div class="relative">
                                <textarea 
                                    name="deskripsi_perkara" 
                                    id="deskripsi_perkara"
                                    rows="5"
                                    placeholder="Jelaskan detail perkara secara lengkap..."
                                    class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none resize-none"
                                    required
                                >{{ old('deskripsi_perkara') }}</textarea>
                                <div class="absolute top-3 right-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('deskripsi_perkara')
                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Section 2: Data Surat Kuasa -->
                    <div class="bg-gradient-to-r from-red-800 to-red-900 px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h2 class="text-xl font-semibold text-white">Data Surat Kuasa</h2>
                        </div>
                        <p class="text-red-100 text-sm mt-1 ml-9">Informasi dan dokumen surat kuasa</p>
                    </div>

                    <div class="p-8 space-y-6">
                        <!-- Two Column Layout for Nomor & Tanggal -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nomor Surat -->
                            <div class="group">
                                <label for="nomor_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nomor Surat
                                    <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="nomor_surat" 
                                        id="nomor_surat"
                                        value="{{ old('nomor_surat') }}"
                                        placeholder="001/SK/2025"
                                        class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('nomor_surat')
                                    <p class="text-red-600 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Tanggal Surat -->
                            <div class="group">
                                <label for="tanggal_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Surat
                                    <span class="text-red-800">*</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="date" 
                                        name="tanggal_surat" 
                                        id="tanggal_surat"
                                        value="{{ old('tanggal_surat', date('Y-m-d')) }}"
                                        class="w-full border-2 border-gray-200 rounded-xl shadow-sm px-4 py-3 focus:border-red-800 focus:ring-4 focus:ring-red-100 transition-all duration-300 outline-none"
                                        required
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('tanggal_surat')
                                    <p class="text-red-600 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="group">
                            <label for="file_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                                Upload File Surat Kuasa
                                <span class="text-red-800">*</span>
                            </label>
                            <div class="relative">
                                <div class="flex items-center justify-center w-full">
                                    <label for="file_surat" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-red-50 transition-all duration-300 group-focus-within:border-red-800 group-focus-within:bg-red-50">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-red-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500">
                                                <span class="font-semibold">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500">PDF, JPG, PNG (MAX. 2MB)</p>
                                        </div>
                                        <input 
                                            type="file" 
                                            name="file_surat" 
                                            id="file_surat"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            class="hidden"
                                            required
                                        >
                                    </label>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    Format file yang didukung: PDF, JPG, PNG. Ukuran maksimal 2MB
                                </p>
                            </div>
                            @error('file_surat')
                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- File Preview (Optional JavaScript Enhancement) -->
                        <div id="filePreview" class="hidden mt-4 p-4 bg-green-50 border-2 border-green-200 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-green-800">File Selected</p>
                                    <p id="fileName" class="text-xs text-green-600"></p>
                                </div>
                                <button type="button" onclick="clearFile()" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-8 pb-8">
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a 
                                href="{{ route('admin.clients.show', $client) }}" 
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300 shadow-sm"
                            >
                                Batal
                            </a>
                            <button 
                                type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-semibold rounded-xl hover:from-red-900 hover:to-red-950 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center space-x-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Simpan Perkara & Surat Kuasa</span>
                            </button>
                        </div>
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
        // File upload preview
        document.getElementById('file_surat').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            
            if (file) {
                preview.classList.remove('hidden');
                fileName.textContent = file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
            }
        });

        function clearFile() {
            document.getElementById('file_surat').value = '';
            document.getElementById('filePreview').classList.add('hidden');
        }
    </script>
</x-layout>
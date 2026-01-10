<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-1 h-8 bg-red-800 rounded-full"></div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Progres Perkara</h1>
                </div>
                <p class="text-gray-600 ml-6">Update informasi progres perkara</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-800 p-4 rounded-r-lg" x-data="{ show: true }" x-show="show">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-800 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-red-900 mb-2">Terdapat kesalahan pada input:</h3>
                            <ul class="space-y-1">
                                @error('file_path')
                                    <li class="text-red-800 text-sm">• {{ $message }}</li>
                                @enderror
                                @error('file_invoice')
                                    <li class="text-red-800 text-sm">• {{ $message }}</li>
                                @enderror
                                @error('judul_progres')
                                    <li class="text-red-800 text-sm">• {{ $message }}</li>
                                @enderror
                                @error('tanggal_progres')
                                    <li class="text-red-800 text-sm">• {{ $message }}</li>
                                @enderror
                                @error('urutan')
                                    <li class="text-red-800 text-sm">• {{ $message }}</li>
                                @enderror
                            </ul>
                        </div>
                    </div>
                    <button @click="show = false" class="text-red-800 hover:text-red-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            <!-- Form Container -->
            <form
                action="{{ route('admin.progres.update', ['client' => $client->id, 'perkara' => $perkara->id, 'progres' => $progres->id]) }}"
                method="POST" 
                enctype="multipart/form-data"
                x-data="{ 
                    fileName: '', 
                    invoiceFileName: '',
                    filesCount: 0,
                    invoicesCount: 0,
                    handleFiles(event, type) {
                        const files = event.target.files;
                        if (type === 'document') {
                            this.filesCount = files.length;
                            this.fileName = files.length > 1 ? `${files.length} file dipilih` : files[0]?.name || '';
                        } else {
                            this.invoicesCount = files.length;
                            this.invoiceFileName = files.length > 1 ? `${files.length} file dipilih` : files[0]?.name || '';
                        }
                    }
                }"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Data Progres Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-800 to-red-700 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Data Progres
                        </h2>
                    </div>

                    <div class="p-6 space-y-5">
                        <!-- Judul Progres -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Progres <span class="text-red-800">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="judul_progres" 
                                value="{{ old('judul_progres', $progres->judul_progres) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all outline-none"
                                placeholder="Contoh: Sidang Pertama"
                                required>
                        </div>

                        <!-- Tanggal & Urutan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Progres <span class="text-red-800">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="tanggal_progres" 
                                    value="{{ old('tanggal_progres', $progres->tanggal_progres) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all outline-none"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Urutan <span class="text-red-800">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    name="urutan" 
                                    value="{{ old('urutan', $progres->urutan) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all outline-none"
                                    placeholder="1"
                                    min="1"
                                    required>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan
                            </label>
                            <textarea 
                                name="keterangan" 
                                rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all outline-none resize-none"
                                placeholder="Tambahkan keterangan atau catatan detail...">{{ old('keterangan', $progres->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Upload Documents Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-800 to-red-700 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Unggah Dokumen
                        </h2>
                    </div>

                    <div class="p-6 space-y-5">
                        <!-- Current Documents Display -->
                        @if($progres->dokumen && $progres->dokumen->where('jenis_dokumen', 'progres')->count() > 0)
                        <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-blue-800 mb-2">Dokumen Progres Saat Ini ({{ $progres->dokumen->where('jenis_dokumen', 'progres')->count() }} file)</p>
                                    <div class="space-y-2">
                                        @foreach($progres->dokumen->where('jenis_dokumen', 'progres') as $dok)
                                        <div class="flex items-center justify-between bg-white rounded p-2">
                                            <span class="text-xs text-blue-600 truncate flex-1">{{ basename($dok->file_path) }}</span>
                                            <a 
                                                href="{{ asset('storage/' . $dok->file_path) }}" 
                                                target="_blank"
                                                class="ml-2 px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition-colors flex-shrink-0">
                                                Lihat
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Upload Dokumen -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Dokumen Progres Baru
                                <span class="text-gray-400 text-xs">(Opsional - upload untuk menambahkan dokumen)</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="file" 
                                    name="file_path[]" 
                                    multiple
                                    @change="handleFiles($event, 'document')"
                                    class="hidden"
                                    id="file_path"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <label 
                                    for="file_path"
                                    class="flex items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-lg px-4 py-8 cursor-pointer hover:border-red-800 hover:bg-red-50 transition-all">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600">
                                            <span class="font-semibold text-red-800">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, JPG, PNG (max. 10MB)</p>
                                        <p x-show="filesCount > 0" x-text="fileName" class="mt-2 text-sm font-medium text-red-800"></p>
                                    </div>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                <svg class="w-4 h-4 inline text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                File baru akan ditambahkan ke dokumen yang sudah ada
                            </p>
                        </div>

                        <!-- Current Invoices Display -->
                        @if($progres->dokumen && $progres->dokumen->where('jenis_dokumen', 'invoice')->count() > 0)
                        <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-green-800 mb-2">Dokumen Invoice Saat Ini ({{ $progres->dokumen->where('jenis_dokumen', 'invoice')->count() }} file)</p>
                                    <div class="space-y-2">
                                        @foreach($progres->dokumen->where('jenis_dokumen', 'invoice') as $dok)
                                        <div class="flex items-center justify-between bg-white rounded p-2">
                                            <span class="text-xs text-green-600 truncate flex-1">{{ basename($dok->file_path) }}</span>
                                            <a 
                                                href="{{ asset('storage/' . $dok->file_path) }}" 
                                                target="_blank"
                                                class="ml-2 px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors flex-shrink-0">
                                                Lihat
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Upload Invoice -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Dokumen Invoice Baru
                                <span class="text-gray-400 text-xs">(Opsional - upload untuk menambahkan invoice)</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="file" 
                                    name="file_invoice[]" 
                                    multiple
                                    @change="handleFiles($event, 'invoice')"
                                    class="hidden"
                                    id="file_invoice"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <label 
                                    for="file_invoice"
                                    class="flex items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-lg px-4 py-8 cursor-pointer hover:border-red-800 hover:bg-red-50 transition-all">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600">
                                            <span class="font-semibold text-red-800">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, JPG, PNG (max. 10MB)</p>
                                        <p x-show="invoicesCount > 0" x-text="invoiceFileName" class="mt-2 text-sm font-medium text-red-800"></p>
                                    </div>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                <svg class="w-4 h-4 inline text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                File baru akan ditambahkan ke invoice yang sudah ada
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between gap-4 pt-2">
                    <a 
                        href="{{ route('admin.perkara.show', ['client' => $client->id, 'perkara' => $perkara->id]) }}"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="px-8 py-2.5 bg-gradient-to-r from-red-800 to-red-700 text-white rounded-lg hover:from-red-900 hover:to-red-800 transition-all font-medium shadow-md hover:shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Progres
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layout>
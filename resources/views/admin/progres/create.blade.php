<x-layout>
    <div class="">
        @error('file_path')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('file_invoice')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('judul_progres')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            
        @enderror
        @error('tanggal_progres')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('urutan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="container mx-auto px-6 py-6">

        <h1 class="text-2xl font-bold mb-6">Tambah Progres Perkara</h1>

        <form
            action="{{ route('admin.progres.store', [
                'client' => $client->id,
                'perkara' => $perkara->id,
            ]) }}"
            method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf

            {{-- ================= PROGRES ================= --}}
            <div>
                <h2 class="font-semibold mb-2">Data Progres</h2>

                <div class="mb-3">
                    <label class="block">Judul Progres</label>
                    <input type="text" name="judul_progres" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="block">Tanggal Progres</label>
                    <input type="date" name="tanggal_progres" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="block">Urutan</label>
                    <input type="number" name="urutan" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="block">Keterangan</label>
                    <textarea name="keterangan" class="w-full border rounded px-3 py-2"></textarea>
                </div>
            </div>

            <div>
                <div class="mb-3">
                    <label class="block">Upload Dokumen</label>
                    <input type="file" name="file_path" multiple class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <div>
                <div>

                    <div class="mb-3">
                        <label class="block">Upload Dokumen Invoice</label>
                        <input type="file" name="file_invoice" multiple class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                        Simpan Progres
                    </button>
                </div>

        </form>
    </div>
</x-layout>

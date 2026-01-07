<?php

namespace App\Services\progres;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgresService
{

  public function store(array $data, $client)
  {
   // Kita bungkus dalam transaction biar aman (All or Nothing)
   return DB::transaction(function () use ($data, $client) {
            
    // 1. SIMPAN TABEL UTAMA (ProgresPerkara)
    // Simpan ini dulu untuk mendapatkan ID progresnya
    $progres = $client->progres()->create([
        'judul_progres'   => $data['judul_progres'],
        'keterangan'      => $data['keterangan'], // Mapping dari input form ke kolom db
        'tanggal_progres' => $data['tanggal_progres'],
        'urutan'          => $data['urutan'],
        'created_by'      => Auth::id(),
    ]);

    // 2. SIMPAN TABEL DOKUMEN (DokumenProgres)
    // Cek apakah user mengupload file dokumen?
    if (request()->hasFile('file_path')) {
        $file = request()->file('file_path');
        
        // Upload file
        $path = $file->store('progres-files', 'public');

        // Simpan ke tabel dokumen_progres via relasi
        $progres->dokumen()->create([
            'file_path'  => $path,
            'created_by' => Auth::id(),
            // 'progres_perkara_id' otomatis terisi oleh Laravel lewat relasi
        ]);
    }

    // 3. SIMPAN TABEL INVOICE (Invoice)
    // Cek apakah user mengupload invoice?
    if (request()->hasFile('file_invoice')) {
        $fileInv = request()->file('file_invoice');
        
        // Upload file
        $pathInv = $fileInv->store('invoice-files', 'public');

        // Simpan ke tabel invoices via relasi
        $progres->invoice()->create([
            'file_invoice' => $pathInv,
            'status'       => 'belum_bayar', // Default status, sesuaikan kebutuhan
            'created_by'   => Auth::id(),
        ]);
    }

    return $progres;
});
  }
}

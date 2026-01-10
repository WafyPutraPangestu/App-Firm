<?php

namespace App\Services\progres;

use App\Models\ProgresPerkara;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProgresService
{

  public function store(array $data, $client)
  {
   
    return DB::transaction(function () use ($data, $client) {

        // 1. Create the Progres record
        $progres = $client->progres()->create([
            'judul_progres'   => $data['judul_progres'],
            'keterangan'      => $data['keterangan'],
            'tanggal_progres' => $data['tanggal_progres'],
            'urutan'          => $data['urutan'],
            'created_by'      => Auth::id(),
        ]);

        // 2. Handle 'file_path' (Check if it's an array or single file)
        if (request()->hasFile('file_path')) {
            $files = request()->file('file_path');

            // Normalize to array so we can loop even if it's a single file
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $path = $file->store('progres-files', 'public');

                $progres->dokumen()->create([
                    'file_path'  => $path,
                    'created_by' => Auth::id(),
                ]);
            }
        }

        // 3. Handle 'file_invoice' (Check if it's an array or single file)
        if (request()->hasFile('file_invoice')) {
            $filesInv = request()->file('file_invoice');

            if (!is_array($filesInv)) {
                $filesInv = [$filesInv];
            }

            foreach ($filesInv as $fileInv) {
                $pathInv = $fileInv->store('invoice-files', 'public');

                $progres->invoice()->create([
                    'file_invoice' => $pathInv,
                    'status'       => 'belum_bayar',
                    'created_by'   => Auth::id(),
                ]);
            }
        }

        return $progres;
    
});
  }

  public function update(array $data, ProgresPerkara $progres)
  {
      return DB::transaction(function () use ($data, $progres) {
          
          
          $progres->update([
              'judul_progres'   => $data['judul_progres'],
              'keterangan'      => $data['keterangan'] ?? null,
              'tanggal_progres' => $data['tanggal_progres'],
              'urutan'          => $data['urutan'],
          ]);
  
          
          if (isset($data['file_path']) && is_array($data['file_path'])) {
              foreach ($data['file_path'] as $file) {
                  $path = $file->store('progres-files', 'public');
                  
                  
                  $progres->dokumen()->create([
                      'file_path'     => $path,
                      'jenis_dokumen' => 'progres', 
                      'created_by'    => Auth::id(),
                  ]);
              }
          }
  
          
          if (isset($data['file_invoice']) && is_array($data['file_invoice'])) {
              foreach ($data['file_invoice'] as $fileInv) {
                  $pathInv = $fileInv->store('invoice-files', 'public');
                  
                  
                  
                  
                  
                  $progres->invoice()->create([
                      'file_invoice' => $pathInv,
                      'status'       => 'belum_bayar',
                      'created_by'   => Auth::id(),
                  ]);
              }
          }
  
          return $progres;
      });
  }
}

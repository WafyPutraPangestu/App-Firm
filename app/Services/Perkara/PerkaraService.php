<?php

namespace App\Services\Perkara;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratKuasa;

class PerkaraService
{
    public function store(array $data, $client)
    {
        
        return DB::transaction(function () use ($data, $client) {
            
            $perkara = $client->perkara()->create([
                'jenis_perkara' => $data['jenis_perkara'],
                'deskripsi_perkara' => $data['deskripsi_perkara'],
                'status' => 'berjalan',
                'tanggal_mulai' => now(), 
                'created_by' => Auth::id(),
            ]);

             if (request()->hasFile('file_surat')) {
                $filePath = request()->file('file_surat')->store('surat-kuasa', 'public');
                SuratKuasa::create([
                    'perkara_id' => $perkara->id,
                    'uploaded_by' => Auth::id(),
                    'nomor_surat' => $data['nomor_surat'] ?? null,
                    'tanggal_surat' => $data['tanggal_surat'],
                    'file_path' => $filePath,
                ]);
            }

            return $perkara;
        });
    }
}
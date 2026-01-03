<?php

namespace App\Services\Perkara;

use Illuminate\Support\Facades\Auth;

class PerkaraService
{

  public function store(array $data, $client)
  {
    $client->Perkara()->create([
      'jenis_perkara' => $data['jenis_perkara'],
      'deskripsi_perkara' => $data['deskripsi_perkara'],
      'status' => 'draft',
      'tanggal_mulai' => $data['tanggal_mulai'] ?? null,
      'tanggal_selesai' => $data['tanggal_selesai'] ?? null,
      'created_by' => Auth::id(),
    ]);
  }
}

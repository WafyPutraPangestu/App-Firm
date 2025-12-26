<?php

namespace App\Services\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class ClientService
{
    public function store(array $data): Client
    {
       return Client::create([
            'created_by' => Auth::id(),
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat']?? null,
            'nik' => $data['nik']?? null,
            'status' => 'pending',
       ]);
    }
    public function update(Client $client, array $data): Client
    {
        $client->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'] ?? null,
            'nik' => $data['nik'] ?? null,
        ]);

        return $client;
    }
}
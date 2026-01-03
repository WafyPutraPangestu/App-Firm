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
            'nama_perusahaan' => $data['nama_perusahaan'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'] ?? null,
            'jenis_client' => $data['jenis_client'],
            'status' => 'pending',
        ]);
    }
    public function update(Client $client, array $data): Client
    {
        $client->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'nama_perusahaan' => $data['nama_perusahaan'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'] ?? null,
            'jenis_client' => $data['jenis_client'],
        ]);

        return $client;
    }
    public function show(Client $client): Client
    {
       $client->load('perkara');
        return $client;
    }
    public function countClients(): int
    {
        return Client::all()->count();
    }
}

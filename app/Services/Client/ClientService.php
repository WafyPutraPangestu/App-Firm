<?php

namespace App\Services\Client;

use App\Models\Client;
use App\Models\Perkara;
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
            'status' => 'aktif',
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
        return Perkara::all()->count();
    }
    public function countPerkara(): int
    {
        return Perkara::count();
    }

    /**
     * Get client statistics for dashboard
     */
    public function getStatistics(): array
    {
        return [
            'total' => Client::count(),
            'aktif' => Client::where('status', 'aktif')->count(),
            'nonaktif' => Client::where('status', 'nonaktif')->count(),
            'retainer' => Client::where('jenis_client', 'retainer')->count(),
            'litigasi' => Client::where('jenis_client', 'litigasi')->count(),
            'non_litigasi' => Client::where('jenis_client', 'non_litigasi')->count(),
            'total_perkara' => Perkara::count(),
            'perkara_berjalan' => Perkara::where('status', 'berjalan')->count(),
            'perkara_selesai' => Perkara::where('status', 'selesai')->count(),
        ];
    }

    /**
     * Get recent clients
     */
    public function getRecentClients(int $limit = 5)
    {
        return Client::with('admin')
            ->latest()
            ->limit($limit)
            ->get();
    }
}

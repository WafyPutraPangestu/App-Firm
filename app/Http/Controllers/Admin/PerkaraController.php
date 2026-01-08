<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perkara\PerkaraStoreRequest;
use App\Models\Client;
use App\Models\Perkara;
use App\Services\Perkara\PerkaraService;
use Illuminate\Http\Request;

class PerkaraController extends Controller
{
    public function create(PerkaraService $service, $client)
    {

        return view('admin.perkara.create', compact('client'));
    }
    public function store(PerkaraStoreRequest $request, PerkaraService $service, Client $client)
    {
        
        $service->store($request->validated(), $client);

        return redirect()
            ->route('admin.clients.show', $client->id)
            ->with('success', 'Perkara dan Surat Kuasa berhasil dibuat.');
    }
    public function show(PerkaraService $service, Perkara $perkara, Client $client)
    {

        return view('admin.perkara.show', compact('client', 'perkara'));
    }
    
    public function finish(Client $client, Perkara $perkara)
    {
        abort_unless($perkara->client_id === $client->id, 404);
        if ($perkara->status === 'selesai') {
            return redirect()
                ->route('admin.perkara.show', [
                    'client' => $client->id,
                    'perkara' => $perkara->id
                ])
                ->with('info', 'Perkara ini sudah ditandai sebagai selesai.');
        }
        $perkara->update([
            'status' => 'selesai',
            'tanggal_selesai' => now(), 
        ]);
        return redirect()
            ->route('admin.perkara.show', [
                'client' => $client->id,
                'perkara' => $perkara->id
            ])
            ->with('success', 'Perkara berhasil ditandai sebagai selesai.');
    }
    public function reopen(Client $client, Perkara $perkara)
    {
        abort_unless($perkara->client_id === $client->id, 404);
        
        if ($perkara->status === 'berjalan') {
            return redirect()
                ->route('admin.perkara.show', [
                    'client' => $client->id,
                    'perkara' => $perkara->id
                ])
                ->with('info', 'Perkara ini masih berjalan.');
        }
        
        $perkara->update([
            'status' => 'berjalan',
            'tanggal_selesai' => null,
        ]);
        
        return redirect()
            ->route('admin.perkara.show', [
                'client' => $client->id,
                'perkara' => $perkara->id
            ])
            ->with('success', 'Perkara berhasil dibuka kembali.');
    }
    
}

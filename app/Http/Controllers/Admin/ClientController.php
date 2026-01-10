<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use App\Models\User;
use App\Services\Client\ClientService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index()
    {
        $user = Client::with('admin')->latest()->SimplePaginate(10);
        
        
        $clientService = app(\App\Services\Client\ClientService::class);
        $stats = $clientService->getStatistics();
        
        return view('admin.client.index', compact('user', 'stats'));
    }
    public function create()
    {

        return view('admin.client.create');
    }
    public function store(ClientStoreRequest $request, ClientService $service)
    {
        // dd($request->all());
        $service->store($request->validated());
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    public function update(ClientUpdateRequest $request, ClientService $service, Client $client)
    {
        $service->update($client, $request->validated());
        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Berhasil menghapus client.');
    }
    public function show(ClientService $service, Client $client)
    {
        $client = $service->show($client);
        $perkara = $service->getPerkaraPaginated($client, 5);
        $countClients = $service->countClients();
       
        return view('admin.client.show', compact('client','countClients','perkara'));
    }
    public function generateKey(Client $client)
    {
       
        $clientKey = bin2hex(random_bytes(2));
        $expiredDate = now();
    
        switch ($client->level) { 
            case 'retainer':
                $expiredDate = now()->addMonth();
                break;
            case 'litigasi':
                $expiredDate = now()->addYear(1);
                break;
            case 'non_litigasi':
                $expiredDate = now()->addMonth(5);
                break;
            default:
                $expiredDate = now()->addMonth();
                break;
        }
    
        try {
    
            $client->update([
                'client_key' => $clientKey,
                'client_key_expired_at' => $expiredDate,
            ]);
    
            $dataClient = [
                'nama_lengkap' => $client->nama_lengkap,
                'email' => $client->email,
                'client_key' => $clientKey,
                'client_key_expired_at' => $expiredDate
            ];
    
         
            Mail::to($client->email)->send(new \App\Mail\SendMail($dataClient));
    
         
            return redirect()->route('admin.clients.index')
                ->with('success', 'Key berhasil dibuat dan email telah terkirim ke ' . $client->nama_lengkap);
    
        } catch (\Exception $e) {
           
            return redirect()->back()
                ->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}

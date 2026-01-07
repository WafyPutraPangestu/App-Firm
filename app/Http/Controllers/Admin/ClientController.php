<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use App\Models\User;
use App\Services\Client\ClientService;
use Illuminate\Support\Facades\Hash;

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
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
    public function show(ClientService $service, Client $client)
    {
        $client = $service->show($client);
        $countClients = $service->countClients();
       
        return view('admin.client.show', compact('client','countClients'));
    }
    public function generateKey(Client $client)
    {
        $clientKey = bin2hex(random_bytes(2));
        // $hashedKey = Hash::make($clientKey);
        $client->update([
            // 'client_key' =>  $hashedKey,
            'client_key' =>  $clientKey,
            'client_key_expired_at' => now()->addMonth(),
        ]);

     

        return redirect()->route('admin.clients.index')->with('success', 'Client key generated successfully.');
    }
}

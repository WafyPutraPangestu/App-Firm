<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use App\Models\User;
use App\Services\Client\ClientService;


class ClientController extends Controller
{
     public function index()
    {
       $user = Client::latest()->SimplePaginate(10);
        return view('admin.clients.index', compact('user'));
    }
    public function create()
    {
        
        return view('admin.clients.create');
    }
    public function store(ClientStoreRequest $request, ClientService $service)
    {
        // dd($request->all());
        $service->store($request->validated());
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }
   
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
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

}

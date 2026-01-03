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
            ->with('success', 'Perkara berhasil dibuat & Tanggal Mulai tercatat otomatis.');
    }
    public function show(PerkaraService $service, Perkara $perkara, Client $client)
    {

        return view('admin.perkara.show', compact('client', 'perkara'));
    }
}

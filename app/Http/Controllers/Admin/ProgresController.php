<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Perkara;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function show($client, $perkara)
    {
        return view('admin.progres.show');
    }

    public function create(Perkara $perkara, Client $client )
    {
        abort_unless($perkara->client_id === $client->id, 404);

        return view('admin.progres.create', compact('client','perkara'));
    }

    public function store(Request $request, Client $client, Perkara $perkara)
    {
        abort_unless($perkara->client_id === $client->id, 404);

        

        return redirect()
            ->route('admin.perkara.show', [
                'client' => $client->id,
                'perkara' => $perkara->id
            ])
            ->with('success', 'Progres berhasil ditambahkan.');
    }
}

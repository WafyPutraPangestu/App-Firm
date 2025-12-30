<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Perkara\PerkaraService;
use Illuminate\Http\Request;

class PerkaraController extends Controller
{
    public function create(PerkaraService $service, $client)
    {
        // dd($client);
        $client = $service->show($client);
        return view('admin.perkara.create', compact('client'));
    }
}

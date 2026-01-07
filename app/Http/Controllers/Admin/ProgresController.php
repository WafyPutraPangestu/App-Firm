<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Progres\ProgresStoreRequest;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Perkara;
use App\Services\progres\ProgresService;
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

    public function store(ProgresService $Service, ProgresStoreRequest $request,  Perkara $perkara, Client $client)
    {
        // dd($request->all());
        abort_unless($perkara->client_id === $client->id, 404);

         $Service->store($request->validated(), $perkara);

        return redirect()
            ->route('admin.perkara.show', [
                'perkara' => $perkara->id,
                'client' => $client->id,

            ])
            ->with('success', 'Progres berhasil ditambahkan.');
    }
    public function toggleStatus(Invoice $invoice)
    {
        try {
            // Toggle status
            $newStatus = $invoice->status === 'lunas' ? 'belum_bayar' : 'lunas';
            
            $invoice->update([
                'status' => $newStatus
            ]);
            
            return response()->json([
                'success' => true,
                'status' => $newStatus,
                'message' => $newStatus === 'lunas' 
                    ? 'Invoice berhasil ditandai sebagai lunas' 
                    : 'Status invoice berhasil diubah menjadi belum bayar'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status invoice'
            ], 500);
        }
    }
    
    /**
     * Download invoice file
     */
    public function download(Invoice $invoice)
    {
        $filePath = storage_path('app/public/' . $invoice->file_invoice);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        return response()->download($filePath);
    }

}

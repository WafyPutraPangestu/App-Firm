<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'created_by',
        'progres_perkara_id',
        'nomor_invoice',
        'jumlah',
        'keterangan',
        'status',
        'tanggal_invoice'
    ];


    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function progres()
    {
        return $this->belongsTo(ProgresPerkara::class);
    }
}


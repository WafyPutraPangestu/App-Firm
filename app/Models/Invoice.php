<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'created_by',
        'progres_perkara_id',
        'file_invoice',
        'status',
    ];


    protected $casts = [
        'tanggal_invoice' => 'date',
        'jumlah' => 'decimal:2',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function progres()
    {
        return $this->belongsTo(ProgresPerkara::class, 'progres_perkara_id');
    }

    /**
     * Accessor untuk mendapatkan Perkara
     */
    public function getPerkaraAttribute()
    {
        return $this->progres?->perkara;
    }

}

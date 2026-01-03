<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'created_by',
        'file_invoice',
        'status',
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

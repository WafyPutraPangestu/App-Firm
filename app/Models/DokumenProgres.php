<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenProgres extends Model
{
    protected $fillable = [
        'created_by',
        'progres_perkara_id',
        'nama_dokumen',
        'file_path',
        'tipe_dokumen'
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


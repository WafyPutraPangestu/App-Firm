<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKuasa extends Model
{
    protected $fillable = [
        'uploaded_by','perkara_id', 'nomor_surat',
        'tanggal_surat', 'file_path'
    ];



    public function uploader()
{
    return $this->belongsTo(User::class, 'uploaded_by');
}

    public function perkara()
    {
        return $this->belongsTo(Perkara::class);
    }
}


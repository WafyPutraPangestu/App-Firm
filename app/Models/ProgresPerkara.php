<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresPerkara extends Model
{
     protected $table = 'progres_perkaras';
    protected $fillable = [
        'created_by','perkara_id', 'judul_progres',
        'keterangan', 'tanggal_progres', 'urutan'
    ];

    protected $casts = [
        'tanggal_progres' => 'date',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function perkara()
    {
        return $this->belongsTo(Perkara::class, 'perkara_id');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenProgres::class, 'progres_perkara_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'progres_perkara_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresPerkara extends Model
{
    protected $fillable = [
        'created_by','perkara_id', 'judul_progres',
        'keterangan', 'tanggal_progres', 'urutan'
    ];

    public function admin()
{
    return $this->belongsTo(User::class, 'created_by');
}
    public function perkara()
    {
        return $this->belongsTo(Perkara::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenProgres::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}


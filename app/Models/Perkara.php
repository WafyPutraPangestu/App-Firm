<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perkara extends Model
{
    protected $fillable = [
        'created_by','client_id', 'jenis_perkara',
        'deskripsi_perkara', 'status',
        'tanggal_mulai', 'tanggal_selesai'
    ];

    public function admin()
{
    return $this->belongsTo(User::class, 'created_by');
}

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function suratKuasa()
    {
        return $this->hasOne(SuratKuasa::class);
    }

    public function progres()
    {
        return $this->hasMany(ProgresPerkara::class)->orderBy('urutan');
    }
}


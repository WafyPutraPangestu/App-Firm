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

    /**
     * PERBAIKAN: Gunakan hasManyThrough karena Invoice 
     * terhubung lewat ProgresPerkara
     * 
     * Structure: Perkara → ProgresPerkara → Invoice
     */
    public function invoices()
    {
        return $this->hasManyThrough(
            Invoice::class,
            ProgresPerkara::class,
            'perkara_id',
            'progres_perkara_id',
            'id',
            'id'
        );
    }

    public function progres()
    {
        return $this->hasMany(ProgresPerkara::class, 'perkara_id')->orderBy('urutan');
    }

    /**
     * Accessor untuk mendapatkan dokumen dari semua progress
     */
 

public function documents()
{
    return $this->hasManyThrough(
        DokumenProgres::class,
        ProgresPerkara::class,
        'perkara_id',
        'progres_perkara_id',
        'id',
        'id'
    );
}

    protected static function booted()
    {
        static::creating(function ($perkara) {
            if (is_null($perkara->tanggal_mulai)) {
                $perkara->tanggal_mulai = now();
            }
        });
    }

}


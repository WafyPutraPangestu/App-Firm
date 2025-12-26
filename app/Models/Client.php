<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'created_by',
        'nama_lengkap',
        'nama_perusahaan',
        'email',
        'no_hp',
        'alamat',
        'jenis_client',
        'client_key',
        'client_key_expired_at',
        'status'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function perkara()
    {
        return $this->hasMany(Perkara::class);
    }
}

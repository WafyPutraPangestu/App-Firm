<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenProgres extends Model
{
    protected $fillable = [
        'created_by',
        'progres_perkara_id',
        'file_path'

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

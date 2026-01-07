<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Chat extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'id_chat';
    protected $fillable = [
        'id_client',
        'id_admin',
        'pengirim',
        'isi_pesan',
        'status_baca',
    ];
    /**
     * Relasi: Chat dimiliki oleh satu Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }
    /**
     * Relasi: Chat dimiliki/dibalas oleh satu Admin (User)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }
}

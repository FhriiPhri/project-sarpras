<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanSarpras extends Model
{
    protected $table = 'peminjaman_sarana';
    protected $fillable = [
        'user_id', 'barang_id', 'approver_id', 'tanggal_pinjam', 
        'tanggal_kembali', 'tanggal_dikembalikan', 'jumlah', 'tujuan',
        'status', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
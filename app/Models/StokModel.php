<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari nama model
    protected $table = 't_stok';
    // Tentukan kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'barang_id',
        'user_id',
        'stok_tanggal',
        'stok_jumlah'
    ];

    // Tentukan relasi ke model barang (m_barang)
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    // Tentukan relasi ke model user (m_user)
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}

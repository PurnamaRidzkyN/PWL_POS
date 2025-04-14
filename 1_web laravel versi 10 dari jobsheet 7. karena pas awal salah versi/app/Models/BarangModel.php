<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; // Nama tabel di database
    protected $primaryKey = 'barang_id'; // Primary key
    public $timestamps = true; // Aktifkan timestamps (created_at & updated_at)

    protected $fillable = [
        'kategori_id',
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual'
    ];

    /**
     * Relasi ke tabel m_kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
    public function stok()
    {
        return $this->hasMany(StokModel::class, 'barang_id', 'barang_id');
    }
}

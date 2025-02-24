<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'TV001', 'barang_nama' => 'Televisi', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['kategori_id' => 1, 'barang_kode' => 'HP002', 'barang_nama' => 'Handphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['kategori_id' => 2, 'barang_kode' => 'BJK01', 'barang_nama' => 'Jaket', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['kategori_id' => 2, 'barang_kode' => 'BJK02', 'barang_nama' => 'Kemeja', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['kategori_id' => 3, 'barang_kode' => 'MKN01', 'barang_nama' => 'Biskuit', 'harga_beli' => 5000, 'harga_jual' => 10000],
            ['kategori_id' => 3, 'barang_kode' => 'MKN02', 'barang_nama' => 'Roti', 'harga_beli' => 7000, 'harga_jual' => 12000],
            ['kategori_id' => 4, 'barang_kode' => 'ATL01', 'barang_nama' => 'Pensil', 'harga_beli' => 2000, 'harga_jual' => 5000],
            ['kategori_id' => 4, 'barang_kode' => 'ATL02', 'barang_nama' => 'Penghapus', 'harga_beli' => 1500, 'harga_jual' => 4000],
            ['kategori_id' => 5, 'barang_kode' => 'FRN01', 'barang_nama' => 'Meja', 'harga_beli' => 500000, 'harga_jual' => 700000],
            ['kategori_id' => 5, 'barang_kode' => 'FRN02', 'barang_nama' => 'Kursi', 'harga_beli' => 200000, 'harga_jual' => 300000],
        ];

        DB::table('m_barang')->insert($data);
    }
}

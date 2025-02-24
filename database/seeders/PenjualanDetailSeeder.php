<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            ['barang_id' => 1, 'harga' => 2500000], // Televisi
            ['barang_id' => 2, 'harga' => 3500000], // Handphone
            ['barang_id' => 3, 'harga' => 200000],  // Jaket
            ['barang_id' => 4, 'harga' => 150000],  // Kemeja
            ['barang_id' => 5, 'harga' => 10000],   // Biskuit
            ['barang_id' => 6, 'harga' => 12000],   // Roti
            ['barang_id' => 7, 'harga' => 5000],    // Pensil
            ['barang_id' => 8, 'harga' => 4000],    // Penghapus
            ['barang_id' => 9, 'harga' => 700000],  // Meja
            ['barang_id' => 10, 'harga' => 300000], // Kursi
        ];

        // Loop untuk 10 transaksi penjualan
        for ($i = 1; $i <= 10; $i++) {
            // Ambil 3 barang secara acak
            $selectedItems = array_rand($barang, 3);
            foreach ($selectedItems as $index) {
                DB::table('t_penjualan_detail')->insert([
                    'penjualan_id' => $i,
                    'barang_id' => $barang[$index]['barang_id'],
                    'harga' => $barang[$index]['harga'],
                    'jumlah' => rand(1, 5), // Jumlah barang antara 1 - 5
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('goods_receipts')->insert(
            [
                ['user_id' => 2, 'supplier_id' => 1, 'tanggal_terima' => '2023-01-01', 'nama_barang' => 'Laptop', 'jumlah' => 10, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 2, 'tanggal_terima' => '2023-01-01', 'nama_barang' => 'Printer', 'jumlah' => 5, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 3, 'tanggal_terima' => '2023-01-01', 'nama_barang' => 'Monitor', 'jumlah' => 7, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 4, 'tanggal_terima' => '2023-01-05', 'nama_barang' => 'Keyboard', 'jumlah' => 15, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 5, 'tanggal_terima' => '2023-01-05', 'nama_barang' => 'Mouse', 'jumlah' => 20, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 6, 'tanggal_terima' => '2023-01-08', 'nama_barang' => 'Webcam', 'jumlah' => 8, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 7, 'tanggal_terima' => '2023-01-12', 'nama_barang' => 'Headset', 'jumlah' => 12, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 8, 'tanggal_terima' => '2023-01-12', 'nama_barang' => 'Speaker', 'jumlah' => 9, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 9, 'tanggal_terima' => '2023-01-12', 'nama_barang' => 'Microphone', 'jumlah' => 6, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 10, 'tanggal_terima' => '2023-01-12', 'nama_barang' => 'Projector', 'jumlah' => 4, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 1, 'tanggal_terima' => '2023-01-15', 'nama_barang' => 'Scanner', 'jumlah' => 5, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 2, 'tanggal_terima' => '2023-01-15', 'nama_barang' => 'External Hard Drive', 'jumlah' => 10, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 3, 'tanggal_terima' => '2023-01-20', 'nama_barang' => 'USB Flash Drive', 'jumlah' => 25, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 4, 'tanggal_terima' => '2023-01-20', 'nama_barang' => 'Router', 'jumlah' => 10, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 5, 'tanggal_terima' => '2023-01-20', 'nama_barang' => 'Switch', 'jumlah' => 8, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 6, 'tanggal_terima' => '2023-01-25', 'nama_barang' => 'Modem', 'jumlah' => 12, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 7, 'tanggal_terima' => '2023-01-25', 'nama_barang' => 'Access Point', 'jumlah' => 7, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 8, 'tanggal_terima' => '2023-02-01', 'nama_barang' => 'Firewall', 'jumlah' => 5, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 9, 'tanggal_terima' => '2023-02-01', 'nama_barang' => 'NAS', 'jumlah' => 3, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 10, 'tanggal_terima' => '2023-02-05', 'nama_barang' => 'Server', 'jumlah' => 2, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 1, 'tanggal_terima' => '2023-02-05', 'nama_barang' => 'UPS', 'jumlah' => 6, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 3, 'tanggal_terima' => '2023-02-10', 'nama_barang' => 'RAM', 'jumlah' => 20, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 4, 'tanggal_terima' => '2023-02-10', 'nama_barang' => 'Motherboard', 'jumlah' => 10, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 5, 'tanggal_terima' => '2023-02-15', 'nama_barang' => 'Processor', 'jumlah' => 8, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 6, 'tanggal_terima' => '2023-02-15', 'nama_barang' => 'Graphics Card', 'jumlah' => 5, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 7, 'tanggal_terima' => '2023-02-15', 'nama_barang' => 'SSD', 'jumlah' => 12, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 8, 'tanggal_terima' => '2023-02-20', 'nama_barang' => 'HDD', 'jumlah' => 10, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 9, 'tanggal_terima' => '2023-02-20', 'nama_barang' => 'Cooling Fan', 'jumlah' => 20, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 2, 'supplier_id' => 10, 'tanggal_terima' => '2023-02-25', 'nama_barang' => 'Thermal Paste', 'jumlah' => 30, 'kondisi' => 'baik', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 1, 'tanggal_terima' => '2023-02-25', 'nama_barang' => 'Case', 'jumlah' => 10, 'kondisi' => 'rusak', 'catatan' => ''],
                ['user_id' => 3, 'supplier_id' => 2, 'tanggal_terima' => '2023-02-25', 'nama_barang' => 'Monitor Stand', 'jumlah' => 15, 'kondisi' => 'baik', 'catatan' => '']
            ]
        );
    }
}

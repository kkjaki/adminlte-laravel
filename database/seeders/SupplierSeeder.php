<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('suppliers')->insert([
            ['s_no' => 1, 'nama' => 'PT. Sumber Rejeki', 'kota' => 'Jakarta'],
            ['s_no' => 2, 'nama' => 'CV. Maju Jaya', 'kota' => 'Bandung'],
            ['s_no' => 3, 'nama' => 'PT. Sejahtera Abadi', 'kota' => 'Surabaya'],
            ['s_no' => 4, 'nama' => 'CV. Makmur Sentosa', 'kota' => 'Medan'],
            ['s_no' => 5, 'nama' => 'PT. Berkah Bersama', 'kota' => 'Semarang'],
            ['s_no' => 6, 'nama' => 'CV. Sukses Mandiri', 'kota' => 'Yogyakarta'],
            ['s_no' => 7, 'nama' => 'PT. Karya Utama', 'kota' => 'Malang'],
            ['s_no' => 8, 'nama' => 'CV. Jaya Abadi', 'kota' => 'Solo'],
            ['s_no' => 9, 'nama' => 'PT. Mitra Sejati', 'kota' => 'Makassar'],
            ['s_no' => 10, 'nama' => 'CV. Amanah', 'kota' => 'Palembang'],
        ]);
    }
}

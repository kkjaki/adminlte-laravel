<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('chatbot')->insert([
            ['question' => 'halo', 'replies' => 'Hai! Ada yang bisa saya bantu?'],
            ['question' => 'cara menambah supplier', 'replies' => 'Untuk menambah supplier, anda harus login sebagai admin. Masuk ke menu admin, pilih "Tambah Supplier", lalu isi data yang diminta.'],
            ['question' => 'cara melihat daftar supplier', 'replies' => 'Anda dapat melihat daftar supplier dengan mengetik "Supplier" di kolom pencarian.'],
            ['question' => 'cara mencatat penerimaan barang', 'replies' => 'Untuk mencatat penerimaan barang, masuk ke menu "Penerimaan Barang", pilih supplier, isi detail barang, dan simpan.']
        ]);
    }
}

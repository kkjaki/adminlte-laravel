<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'suppliers';

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        's_no',       // Nomor supplier
        'nama',       // Nama supplier
        'kota',     // Kota supplier
    ];

    /**
     * Mendefinisikan hubungan antara Supplier dan GoodsReceipt
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsReceipts()
    {
        return $this->hasMany(GoodsReceipt::class, 'supplier_id', 's_no');
    }
}

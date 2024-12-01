<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceipt extends Model
{
    protected $fillable = [
        'user_id',
        'supplier_id',
        'tanggal_terima',
        'nama_barang',
        'jumlah',
        'kondisi',
        'catatan'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 's_no');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    protected $table = 'master_barang';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;  // penting!
    protected $keyType = 'string'; // penting!

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'stok',
        'harga_beli',
        'harga_jual',
        'created_by',
        'updated_by',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanBarangModel extends Model
{
    protected $table = 'penjualan_barang';
    protected $primaryKey = 'id';
    public $incrementing = false;  // penting!
    protected $keyType = 'integer'; // penting!

    protected $fillable = [
        'kode_transaksi',
        'id',
        'kode_barang',
        'qty',
    ];
    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}

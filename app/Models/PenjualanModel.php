<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    protected $table = 'transaksi_penjualan';
    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;  // penting!
    protected $keyType = 'string'; // penting!

    protected $fillable = [
        'kode_transaksi',
        'tanggal_bayar',
        'total_bayar',
        'metode_bayar',
        'created_by',
        'updated_by',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}

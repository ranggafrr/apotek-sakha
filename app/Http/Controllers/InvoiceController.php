<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;

class InvoiceController extends Controller
{
    public function print($kode_transaksi)
    {
        $transaksi = TransaksiPenjualan::with('details')
            ->where('kode_transaksi', $kode_transaksi)
            ->firstOrFail();

        return view('apps.invoice.invoice', compact('transaksi'));
    }
}
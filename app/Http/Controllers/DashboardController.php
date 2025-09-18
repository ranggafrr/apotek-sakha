<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\PenjualanBarangModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $produkTerlaris = PenjualanBarangModel::select(
            'penjualan_barang.kode_barang',
            'master_barang.nama_barang',
            DB::raw('SUM(penjualan_barang.qty) as total_terjual')
        )
            ->join('master_barang', 'penjualan_barang.kode_barang', '=', 'master_barang.kode_barang')
            ->groupBy('penjualan_barang.kode_barang', 'master_barang.nama_barang')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => null]
        ];
        return view('apps.dashboard', [
            "menu" => "Dashboard",
            "page" => 'Dashboard',
            "penjualan" => PenjualanModel::orderBy('kode_transaksi', 'desc')
                ->limit(6)
                ->get(),
            "produk" => $produkTerlaris,
            "breadcrumbs" => $breadcrumbs,
        ]);
    }
}

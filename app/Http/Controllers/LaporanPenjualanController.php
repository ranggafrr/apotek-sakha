<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\PenjualanBarangModel;
use App\Models\ProdukModel;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = PenjualanModel::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_bayar', [$request->start_date, $request->end_date]);
        }

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Laporan Penjualan', 'url' => null],
        ];
        return view('apps.laporan-penjualan.view-data', [
            'data' => $query->get(),
            "menu" => "Laporan penjualan",
            'page' => 'Laporan penjualan',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
    public function detail($kode_transaksi)
    {
        // ambil data barang yang di checkout
        $produkList = PenjualanBarangModel::select(
            'penjualan_barang.*',
            'master_barang.nama_barang',
            'master_barang.harga_jual'
        )
            ->join('master_barang', 'penjualan_barang.kode_barang', '=', 'master_barang.kode_barang')
            ->where('penjualan_barang.kode_transaksi', $kode_transaksi)
            ->get();

        return view('apps.laporan-penjualan.view-detail', [
            "menu" => "Transaksi penjualan",
            "page" => 'Tambah data',
            "produk" => ProdukModel::all(),
            "noTrans" => $kode_transaksi,
            "produkList" => $produkList,
        ]);
    }
    public function print($kode_transaksi)
    {
        $transaksi = PenjualanModel::where('kode_transaksi', $kode_transaksi)
            ->firstOrFail();
        $barang = PenjualanBarangModel::join('master_barang', 'penjualan_barang.kode_barang', '=', 'master_barang.kode_barang')
            ->select('penjualan_barang.*', 'master_barang.nama_barang', 'master_barang.harga_jual')->where('penjualan_barang.kode_transaksi', $kode_transaksi)
            ->get();

        return view('apps.laporan-penjualan.view-print', [
            'transaksi' => $transaksi,
            'barang' => $barang,
            'menu' => 'Laporan penjualan',
            'page' => 'Laporan penjualan',
        ]);
    }
}

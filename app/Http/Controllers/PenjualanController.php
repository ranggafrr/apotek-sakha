<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanBarangModel;
use App\Http\Requests\PenjulanRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Transaksi Penjualan', 'url' => null],
        ];
        return view('apps.transaksi-penjualan.view-data', [
            'data' =>  PenjualanModel::all(),
            "menu" => "Transaksi penjualan",
            'page' => 'Transaksi penjualan',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Generate nomor transaksi
        // Hitung total transaksi hari ini
        if ($request->query('kode_transaksi')) {
            $noTrans = $request->query('kode_transaksi');
        } else {
            $prefix = 'S-' . date('Ymd');
            $totalTransaksiHariIni = PenjualanModel::where('kode_transaksi', 'like', $prefix . '%')
                ->count();
            // Generate nomor transaksi baru
            $nomorUrut = str_pad($totalTransaksiHariIni + 1, 4, '0', STR_PAD_LEFT);
            $noTrans = $prefix . $nomorUrut;
        }
        // ambil data barang yang di checkout
        $produkList = PenjualanBarangModel::select(
            'penjualan_barang.*',
            'master_barang.nama_barang',
            'master_barang.harga_jual'
        )
            ->join('master_barang', 'penjualan_barang.kode_barang', '=', 'master_barang.kode_barang')
            ->where('penjualan_barang.kode_transaksi', $noTrans)
            ->get();

        return view('apps.transaksi-penjualan.add-data', [
            "menu" => "Transaksi penjualan",
            "page" => 'Tambah data',
            "produk" => ProdukModel::all(),
            "noTrans" => $noTrans,
            "produkList" => $produkList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenjulanRequest $request)
    {
        try {
            // ambil data yang divalidasi
            $data = $request->validated();
            // Cek apakah transaksi sudah ada
            $transaksi = PenjualanModel::where('kode_transaksi', $data['kode_transaksi'])->first();
            $produk = ProdukModel::where('kode_barang', $data['kode_barang'])->first();
            $total_bayar = $data['qty'] * $produk->harga_jual;
            $stock_terbaru = $produk->stok - $data['qty'];

            if (!$transaksi) {
                // INSERT transaksi baru
                PenjualanModel::create([
                    'kode_transaksi' => $data['kode_transaksi'],
                    'tanggal_bayar' => Carbon::now(),
                    'total_bayar' => $total_bayar,
                    'created_by' => Session::get('user')->nama_lengkap,
                    'created_at' => Carbon::now()
                ]);

                $message = 'Transaksi berhasil disimpan';
            } else {
                $total = $transaksi['total_bayar'] + $total_bayar;
                PenjualanModel::where('kode_transaksi', $data['kode_transaksi'])
                    ->update([
                        'total_bayar' => $total,
                        'updated_by' => Session::get('user')->nama_lengkap,
                        'updated_at' => Carbon::now()
                    ]);

                $message = 'Transaksi berhasil diupdate';
            }
            // INSERT data produk yang dibeli
            PenjualanBarangModel::create([
                'kode_transaksi' => $data['kode_transaksi'],
                'kode_barang' => $data['kode_barang'],
                'qty' => $data['qty'],
                'created_at' => Carbon::now()
            ]);

            // update total stock terbaru
            ProdukModel::where('kode_barang', $data['kode_barang'])->update([
                'stok' => $stock_terbaru,
            ]);
            return redirect()->route('transaksi-penjualan.create', ['kode_transaksi' => $data['kode_transaksi']])->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('transaksi-penjualan.create')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Ambil semua data produk yang terkait dengan transaksi
            $detailItems = PenjualanBarangModel::where('kode_transaksi', $id)->get();

            // Kembalikan stok ke tabel produk
            foreach ($detailItems as $item) {
                $produk = ProdukModel::where('kode_barang', $item->kode_barang)->first();

                if ($produk) {
                    $produk->update([
                        'stok' => $produk->stok + $item->qty
                    ]);
                }
            }

            // Hapus detail penjualan terlebih dahulu
            PenjualanBarangModel::where('kode_transaksi', $id)->delete();

            // Hapus data transaksi utama
            PenjualanModel::where('kode_transaksi', $id)->delete();

            // Redirect
            return redirect()
                ->route('transaksi-penjualan.index')
                ->with('success', 'Transaksi dan stok produk berhasil dihapus dan dikembalikan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function destroyProduk(string $id)
    {
        try {
            // Ambil data produk yang akan dihapus
            $detail = PenjualanBarangModel::findOrFail($id);

            // Simpan kode_transaksi dan harga produk
            $kodeTransaksi = $detail->kode_transaksi;
            $qty = $detail->qty;

            // Ambil data produk untuk mendapatkan harga
            $produk = ProdukModel::where('kode_barang', $detail->kode_barang)->first();
            if (!$produk) {
                return redirect()
                    ->back()
                    ->with('error', 'Data produk tidak ditemukan.');
            }

            // Hitung pengurangannya
            $kurangiTotal = $qty * $produk->harga_jual;
            $stock_terbaru = $produk->stok + $detail->qty;
            // Update total_bayar di transaksi
            $transaksi = PenjualanModel::where('kode_transaksi', $kodeTransaksi)->first();
            if ($transaksi) {
                $totalBaru = max(0, $transaksi->total_bayar - $kurangiTotal); // pastikan tidak negatif

                $transaksi->update([
                    'total_bayar' => $totalBaru,
                    'updated_by' => Session::get('user')->nama_lengkap,
                    'updated_at' => Carbon::now()
                ]);
            }
            // update stock terbaru
            ProdukModel::where('kode_barang', $detail->kode_barang)->update([
                'stok' => $stock_terbaru,
                'updated_at' => Carbon::now(),
            ]);
            // Hapus detail penjualan
            $detail->delete();

            // Redirect
            return redirect()
                ->route('transaksi-penjualan.create', ['kode_transaksi' => $kodeTransaksi])
                ->with('success', 'Data produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}

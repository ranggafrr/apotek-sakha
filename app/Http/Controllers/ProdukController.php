<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdukRequest;
use App\Models\ProdukModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Master Barang', 'url' => null],
        ];
        return view('apps.master-barang.view-data', [
            'data' =>  ProdukModel::all(),
            "menu" => "Master barang",
            'page' => 'Master barang',
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Master Barang', 'url' => route('master-barang.index')],
            ['label' => 'Tambah Data', 'url' => null],
        ];
        return view('apps.master-barang.add-data', [
            "menu" => "Master barang",
            "page" => 'Tambah data',
            "breadcrumbs" => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukRequest $request)
    {
        try {
            // ambil data yang divalidasi
            $data = $request->validated();
            $random = rand(100000, 999999);
            $kode_barang = 'OB-' . $random;
            // Gabungkan UUID dengan data lainnya
            $storeData = array_merge($data, ['kode_barang' => $kode_barang, 'created_by' => Session::get('user')->nama_lengkap, 'created_at' => Carbon::now()]);

            ProdukModel::create($storeData);
            return redirect()->route('master-barang.index')->with('success', 'Data produk berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('master-barang.index')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
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
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Master Barang', 'url' => route('master-barang.index')],
            ['label' => 'Update Data', 'url' => null],
        ];
        return view('apps.master-barang.update-data', [
            'data' => ProdukModel::where('kode_barang', $id)->first(),
            "menu" => "Master barang",
            "page" => 'Update data',
            "breadcrumbs" => $breadcrumbs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProdukRequest $request, string $kode_barang)
    {
        try {
            // Validasi data dari request
            $data = $request->validated();
            // Gabungkan data dengan updated_by dan updated_at
            $updateData = array_merge($data, [
                'updated_by' => Session::get('user')->nama_lengkap,
                'updated_at' => Carbon::now()
            ]);

            // Update user
            ProdukModel::where('kode_barang', $kode_barang)->update($updateData);

            // Redirect dengan pesan sukses
            return redirect()->route('master-barang.index')->with('success', 'Data produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProdukModel::where('kode_barang', $id)->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('master-barang.index')->with('success', 'Data produk berhasil dihapus.');
        } catch (\Exception $e) {
            // Penanganan error lain
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

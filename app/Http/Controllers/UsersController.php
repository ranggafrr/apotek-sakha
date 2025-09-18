<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Master User', 'url' => null],
        ];
        return view('apps.users.view-data', [
            'data' =>  User::all(),
            "menu" => "Master user",
            'page' => 'Master user',
            "breadcrumbs" => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Master User', 'url' => route('master-user.index')],
            ['label' => 'Tambah Data', 'url' => null],
        ];
        return view('apps.users.add-data', [
            "menu" => "Master user",
            "page" => 'Tambah user',
            "role" => RoleModel::all(),
            "breadcrumbs" => $breadcrumbs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            // Session::get('user')->nama_lengkap
            // Membuat UUID baru
            $uuid = Str::uuid()->toString();
            // ambil data yang divalidasi
            $validatedData = $request->validated();
            // Gabungkan UUID dengan data lainnya
            $storeData = array_merge($validatedData, ['user_id' => $uuid, 'created_by' => Session::get('user')->nama_lengkap, 'created_at' => Carbon::now()]);
            // Hash password sebelum disimpan
            $storeData['password'] = bcrypt($storeData['password']);

            User::create($storeData);
            return redirect()->route('users.index')->with('success', 'Data pengguna berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
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
            ['label' => 'Master User', 'url' => route('master-user.index')],
            ['label' => 'Update Data', 'url' => null],
        ];
        return view('apps.users.update-data', [
            'data' => User::where('user_id', $id)->first(),
            "menu" => "Master user",
            "page" => 'Update user',
            "role" => RoleModel::all(),
            "breadcrumbs" => $breadcrumbs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validated();

            // Cek apakah password diisi atau tidak
            if (empty($validatedData['password'])) {
                unset($validatedData['password']); // Hapus field password jika kosong
            } else {
                // Enkripsi password jika diisi
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            // Gabungkan data dengan updated_by dan updated_at
            $updateData = array_merge($validatedData, [
                'updated_by' => Session::get('user')->nama_lengkap,
                'updated_at' => Carbon::now()
            ]);

            // Update user
            User::where('user_id', $id)->update($updateData);

            // Redirect dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
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
            // Perbarui data pengguna
            User::where('user_id', $id)->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'Data pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            // Penanganan error lain
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

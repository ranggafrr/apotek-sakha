<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Master Role', 'url' => null],
        ];
        return view('apps.roles.view-data', [
            'data' =>  RoleModel::all(),
            "menu" => "Master role",
            'page' => 'Master role',
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
            ['label' => 'Master Role', 'url' => route('role.index')],
            ['label' => 'Tambah Data', 'url' => null],
        ];
        return view('apps.roles.add-data', [
            "menu" => "Master role",
            "page" => 'Tambah role',
            "breadcrumbs" => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            // ambil data yang divalidasi
            $data = $request->validated();
            // Gabungkan UUID dengan data lainnya
            $storeData = array_merge($data, ['created_by' => Session::get('user')->nama_lengkap, 'created_at' => Carbon::now()]);

            RoleModel::create($storeData);
            return redirect()->route('role.index')->with('success', 'Data role berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('role.index')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleModel $roleModel)
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
            ['label' => 'Master Role', 'url' => route('role.index')],
            ['label' => 'Update Data', 'url' => null],
        ];
        return view('apps.roles.update-data', [
            'data' => RoleModel::where('role_id', $id)->first(),
            "menu" => "Master role",
            "page" => 'Update role',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, $role_id)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validated();
            // Gabungkan data dengan updated_by dan updated_at
            $updateData = array_merge($validatedData, [
                'updated_by' => Session::get('user')->nama_lengkap,
                'updated_at' => Carbon::now()
            ]);

            // Update user
            RoleModel::where('role_id', $role_id)->update($updateData);

            // Redirect dengan pesan sukses
            return redirect()->route('role.index')->with('success', 'Data role berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $role_id)
    {
        try {
            RoleModel::where('role_id', $role_id)->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('role.index')->with('success', 'Data role berhasil dihapus.');
        } catch (\Exception $e) {
            // Penanganan error lain
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('welcome');
    }
    public function loginVerification(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $usernameCheck = User::where('username', $credentials['username'])->count();
        $loginStatus = false;
        if ($usernameCheck > 0) {
            $hashPassword = User::where('username', $credentials['username'])->value('password');
            if (HASH::check($credentials['password'], $hashPassword)) {
                $loginStatus = true;
            }
        }
        if ($loginStatus) {
            $data = User::where('username', $credentials['username'])->first();
            session::put('loginStatus', true);
            session::put('user', $data);
        } else {
            return back()->with('error', 'Maaf!, Username atau Password Anda Salah!')->withInput(old('username'));
        }

        return redirect()->route('dashboard');
    }
    public function logout()
    {
        // Hapus semua sesi
        session()->flush();

        return redirect()->route('login')->with('success', 'Sampai jumpa!');
    }
}

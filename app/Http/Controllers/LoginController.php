<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

         // Mengirim permintaan ke API untuk memverifikasi kredensial
         $response = Http::post('http://localhost:8001/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Memeriksa respons dari API
        if ($response->successful()) {
            // Login berhasil, alihkan ke halaman home
            return redirect()->route('home');
        }

        // Login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

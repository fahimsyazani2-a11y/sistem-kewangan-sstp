<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tunjukkan borang login (Hanya di URL rahsia)
     */
    public function showLogin()
    {
        // Jika sudah login, terus ke dashboard admin
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Proses masuk (Login)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat Datang, Log Masuk Berjaya!');
        }

        return back()->withErrors([
            'email' => 'Maklumat login yang diberikan tidak sah.',
        ])->onlyInput('email');
    }

    /**
     * Proses keluar (Logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('warans.index')
            ->with('success', 'Anda telah log keluar dari sistem.');
    }
}
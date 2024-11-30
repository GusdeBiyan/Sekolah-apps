<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        return view('auth-page.login');
    }

    // Melakukan login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Melakukan login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            session()->flash('toast_message', 'Login Berhasil');
            session()->flash('toast_icon', 'success');
            return redirect()->intended('/dashboard');
        } else {

            session()->flash('toast_message', 'Email atau Password salah');
            session()->flash('toast_icon', 'error');
            return back();
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

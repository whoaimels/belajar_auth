<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login() {
        return view('login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
    
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }
    
        return back()->withErrors([
            'email' => 'Login invalid. email atau password salah.',
        ])->onlyInput('email');
    }
    

    function registrasi() {
        return view('registrasi');
    }

    function submitRegistrasi(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nomorhp' => 'required|string|max:20',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Masukkan minimal 6 karakter untuk password.'
        ]);
        
        User::create([
            'name'     => $request->name, 
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'notelp'  => $request->notelp
        ]);
        
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login() {
        return view('login');
    }

    function authenticate(Request $request) {
        //return $request->all();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password'  => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
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
            'password' => 'required|string|min:8',
            'nomorhp' => 'required|string|max:20',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Masukkan minimal 8 karakter untuk password.'
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nomorhp = $request->nomorhp;
        
        $user->save();
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
 }

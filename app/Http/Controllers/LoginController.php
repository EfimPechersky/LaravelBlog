<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function show_form():View{
        return view('login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password'=>['required','string']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return redirect('/login')->withErrors([
            'password' => 'Неверный email или пароль',
        ])->onlyInput('password');
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
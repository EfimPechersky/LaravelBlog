<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class RegistartionController extends Controller
{
    public function show_form():View{
        return view('registration');
    }
    public function create_user(Request $request){
        $request->validate([
            'name' => ['required','string','unique:App\Models\User,name'],
            'email' => ['required','email','unique:App\Models\User,email'],
            'password'=>['required','string', 'min:6', 'confirmed']
        ]);
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/');
    }
}
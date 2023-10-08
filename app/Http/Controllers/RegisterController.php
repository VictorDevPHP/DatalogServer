<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function create()
    {
        Log::channel('atividades')->info('O usuario '. auth()->user()->name. ' acessou a tela de cadastro');
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Log::channel('atividades')->info('O usuario '. auth()->user()->name. ' cadastrou um novo usuario');
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required',
        'userPassword' => 'required',
    ]);

    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('userPassword'),
    ];

    if (Auth::attempt($credentials)) {
        return redirect()->intended(route('home'));
    }

    return redirect(route('login'))->with('error', 'Try again');
}

    public function registerPost(Request $request)
    {
        $request->validate([
            'userName' => 'required',
            'userEmail' => 'required|email|unique:users,email',
            'userPassword' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('userName'),
            'email' => $request->input('userEmail'),
            'password' => Hash::make($request->input('userPassword')),
        ]);

        if (!$user) {
            return redirect()->route('registration')->with('error', 'Registration failed. Please try again.');
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}

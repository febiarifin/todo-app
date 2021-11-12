<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        try {
            return view('login');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/')->with('danger', $e->getMessage());
        }
    }

    public function auth(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('successLogin')->with(['message', 'Hello ' . $request->email, 'email' => $request->email]);
            }

            return back()->with('invalid', 'Email or password is an incorect.');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/login')->with('danger', $e->getMessage());
        }
    }

    public function successLogin()
    {
        try {
            return view('successLogin');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/login')->with('invalid', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/login')->with('invalid', $e->getMessage());
        }
    }
}
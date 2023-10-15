<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Termwind\Components\Dd;

class AuthController extends Controller
{
    // function redirect google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // function hadle google callback
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        // check if user already exists
        $existingUser = Auth::where('email', $user->email)->first();
        $email = $user->email;

        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
            $request->session()->put('id', $existingUser->id);
            $request->session()->put('user', $existingUser);
            //    check role
            if ($existingUser->role == 1) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        } else {
            // create a new user
            $page   = 'register';

            // return view
            return view('register', compact('page', 'email'));
        }
    }

    // function register
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'kode' => $request->kode,
            'jurusan' => $request->jurusan,
            'role_id' => 3,
        ]);

        $email = $request->email;
        $existingUser = Auth::where('email', $email)->first();
        auth()->login($existingUser, true);
        $request->session()->put('id', $existingUser->id);
        $request->session()->put('user', $existingUser);
        return view('dashboard', compact('email'));

        // return redirect()->route('login')->with('success', 'Register success');
    }

    // function logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return view('login');
    }
}

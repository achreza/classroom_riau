<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
// alert
use RealRashid\SweetAlert\Facades\Alert;


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
        $request->session()->put('avatar', $user->avatar);
        // check if user already exists
        $existingUser = Auth::where('email', $user->email)->first();
        $email = $user->email;

        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
            $request->session()->put('role', $existingUser->role_id);
            $request->session()->put('user', $existingUser);

            if ($existingUser->role_id == 1) {
                $request->session()->put('posisi', 'Admin');
            } else if ($existingUser->role_id == 2) {
                $request->session()->put('posisi', 'Dosen');
            } else if ($existingUser->role_id == 3) {
                $request->session()->put('posisi', 'Mahasiswa');
            }
            //    check role

            return redirect('/dashboard');
        } else {
            // create a new user
            $page   = 'register';

            // return view
            return view('auth.register', compact('page', 'email'));
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
        return redirect('/dashboard');
        //return redirect()->route('login')->with('success', 'Register success');
    }
    public function store(Request $request)
    {
       $user=  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'kode' => $request->kode,
            'jurusan' => $request->jurusan,
            'role_id' => $request->role,
        ]);
        if ($user) {
            Alert::success('Sukses', 'Berhasil Menambah User');
            return redirect()->route('dashboard.index');
        } else {
            Alert::error('Gagal', 'Gagal Menambah User');
            return redirect()->route('dashboard.index');
        }
        return redirect('/dashboard');
    }

    // function logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return view('auth.login');
    }
    public function profile(Request $request)
    {
        $user = User::find($request->session()->get('user')->id);
        return view('profile.index', compact('user'));
    }
    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->kode = $request->kode;
        $user->jurusan = $request->jurusan;
        $user->update();

        return redirect('/profile');
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/dashboard');
    }
}
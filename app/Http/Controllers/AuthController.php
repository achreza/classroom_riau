<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Artisan;
// alert
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\EmailPemberitahuan;
use Illuminate\Support\Facades\Mail;
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

        // Artisan::call('optimize');

        $user = Socialite::driver('google')->stateless()->user();
        $request->session()->put('avatar', $user->avatar);
        // check if user already exists
        $existingUser = Auth::where('email', $user->email)->first();
        $email = $user->email;

        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
            $existingUser->update([
                'is_online' => 1,
            ]);
            $request->session()->put('role', $existingUser->role_id);
            $request->session()->put('user', $existingUser);
            $request->session()->put('email', $existingUser->email);

            if ($existingUser->role_id == 1) {
                $request->session()->put('posisi', 'Admin');
            } else if ($existingUser->role_id == 2) {
                $request->session()->put('posisi', 'Dosen');
            } else if ($existingUser->role_id == 3) {
                $request->session()->put('posisi', 'Mahasiswa');
            }

            return redirect('/dashboard');
        } else {
            // create a new user
            $page   = 'register';

            // return view
            return view('auth.register', compact('page', 'email'));
        }
    }

    //function testEmail
    public function testEmail()
    {
        $data = [
            'subject' => "[IKTN Learning] Tugas baru Telah Ditambahkan",
            'isi' => "
                Dear  \nInformation about your paper Entitled  for ICGT 2023 was Rejected. You can check the Comment Given by Reviewers and their status at https://gcms.uin-malang.ac.id/.\n From there, you can see the current status of the paper, whether a manuscript has been submitted and can edit the abstract information.\n\nRegards,
        Thank you and have a nice day.\n\nWarmest Regards
        Technical and Support-Staff\n
        ICGT-2023",
        ];
        $email_user = request()->session()->get('email');
        Mail::to($email_user)->send(new EmailPemberitahuan($data));
    }

    // function emailTugasBaru
    public function emailTugasBaru($id)
    {
        $user = User::where('id', $id)->first();
        $nama = $user->name;
        $kelas = $user->kelas;
        $data = [
            'subject' => "[IKTN Learning] Tugas baru Telah Ditambahkan",
            'isi' => "
            Hai $nama! Tugas baru telah ditambahkan ke kelas $kelas. Jangan lupa untuk memeriksanya dan tetap terorganisir, jangan sampai melewatkan deadline. Mulai sekarang dan tunjukkan yang terbaik.",
        ];
        $email_user = request()->session()->get('email');
        Mail::to($email_user)->send(new EmailPemberitahuan($data));
    }


    public function emailTerlambat($id)
    {
        $user = User::where('id', $id)->first();
        $nama = $user->name;
        $kelas = $user->kelas;
        $judul = $user->judul;
        $data = [
            'subject' => "[IKTN Learning] Tugas baru Telah Ditambahkan",
            'isi' => "
            Halo, Anda menerima tugas baru dari $nama yang terdaftar di kelas $kelas dengan Status Terlambat.  Silakan cek tugasnya dengan judul: $judul.",
        ];
        $email_user = request()->session()->get('email');
        Mail::to($email_user)->send(new EmailPemberitahuan($data));
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
            'belum_bayar' => 0,
        ]);

        $email = $request->email;
        $existingUser = Auth::where('email', $email)->first();
        auth()->login($existingUser, true);
        $request->session()->put('id', $existingUser->id);
        $request->session()->put('user', $existingUser);
        $existingUser->update([
            'is_online' => 1,
        ]);
        return redirect('/dashboard');
        //return redirect()->route('login')->with('success', 'Register success');
    }
    public function store(Request $request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'kode' => $request->kode,
            'jurusan' => $request->jurusan,
            'role_id' => $request->role,
            'belum_bayar' => 0,
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
        $existingUser = User::find($request->session()->get('user')->id);
        $existingUser->update([
            'is_online' => 0,
        ]);
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

        $request->session()->put('user', $user);
        $temp = $request->session()->get('user');
        if ($temp->role_id == 1) {
            $request->session()->put('posisi', 'Admin');
        } else if ($temp->role_id == 2) {
            $request->session()->put('posisi', 'Dosen');
        } else if ($temp->role_id == 3) {
            $request->session()->put('posisi', 'Mahasiswa');
        }

        // alert success
        if ($user) {
            Alert::success('Sukses', 'Berhasil Mengubah Profile');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Gagal Mengubah Profile');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/dashboard');
    }

    public function flushSession(Request $request)
    {
        $request->session()->flush();
    }

    public function active($id)
    {
        $userIdsArray = explode(',', $id);


        foreach ($userIdsArray as $userId) {
            $user = User::find($userId);
            if ($user->belum_bayar == 1) {
                $newState = 0;
            } else {
                $newState = 1;
            }
        }
        // Update the users
        User::whereIn('id', $userIdsArray)->update(['belum_bayar' => $newState]);

        Alert::success('Sukses', 'Berhasil Mengubah Status User');


        return response()->json(['message' => "User berhasil dinonaktifkan"]);
    }
}

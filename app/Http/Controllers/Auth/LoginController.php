<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\LogActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username tidak boleh kosong',
                'password.required' => 'password tidak boleh kosong',
            ]
        );

        $credential = $request->only('username', 'password');
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === '1' || $user->role === '2') {
                return redirect()->intended('dashboard');
            } elseif ($user->role === '3') {
                return redirect()->intended('home');
            }
        }
        return back()->withErrors([
            'username' => 'Maaf username atau password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function lupapswd()
    {
        return view('auth.lupapassword');
    }

    public function lupa_email(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        //cek email ada atau tidak di tabel user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email Anda Belum Terdaftar');
        }

        //Jika email ditemukan, link ubah password dikirimkan
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Cek email anda untuk merubah pasword')
            : back()->with('error', 'Gagal mengirim link ubah password');
    }

    public function ubah_password($token)
    {
        return view('auth.ubahpasswrod', ['token' => $token]);
    }

    public function update_password(Request $request)
    {
        $request->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'password.required' => 'Password harus diisi',
                'password.min:8' => 'Password minimal 8 karakter'
            ]
        );

        $status = Password::reset(
            $$request->only('email', 'password', 'konfirmasi_password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

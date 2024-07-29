<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $messages = [
            'nama.required' => 'Kolom nama tidak boleh kosong.',
            'email.required' => 'Kolom email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Kolom username tidak boleh kosong.',
            'password.required' => 'Kolom password tidak boleh kosong.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'no_hp.required' => 'Kolom nomor handphone tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:20',
            'email' => 'required|string|email|unique:users,email',
            'username' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'no_hp' => 'required|string|max:15',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal, silakan periksa kembali form Anda.');
        }
        try {
            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'username' => $request->input('username'),
                'password' => Hash::make($request->password),
                'no_hp' => $request->no_hp,
                'role' => '3',
            ]);
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan Login.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Integrity constraint violation: 1062 Duplicate entry
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Username atau email sudah terdaftar.');
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan pada server. Silakan coba lagi.');
        }
    }
}

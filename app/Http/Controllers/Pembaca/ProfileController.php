<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {

        $user = User::findOrFail(Auth::id());

        return view('pembaca.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email|uniqueusers, email' . $id,
            'no_hp' => 'required|regex:/^\+?[0-9]+$/|min:10|max:12',
        ], [
            'nama.required' => 'Nama sesuait KTP',
            'email.required' => 'Cantumkan email yang masih aktif',
            'no_hp.required' => 'No Handphone wajib diisi',
            'no_hp.regex' => 'No Handphone wajib diawali +62',
            'no_hp.min' => 'No Handphone harus memiliki panjang minimal 10 karakter',
            'no_hp.max' => 'No Handphone harus memiliki panjang maksimal 12 karakter',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;

            $user->save();

            echo json_encode(['status' => TRUE]);
        }
    }

    public function update_foto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format harus berupa gambar jpeg,png, atau jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    if (public_path($user->foto)) {
                        unlink($user->foto);
                    }
                }
                $foto = $request->file('foto');
                $file_name = $user->username . '.' . $foto->getClientOriginalExtension();
                $path = 'uploads/foto_profile';
                $foto->move($path, $file_name);
                $user->foto = "$path/$file_name";
            }
            $user->save();
            $foto_baru = $user->foto;
            echo json_encode(['status' => true, 'foto' => $foto_baru]);
        }
    }
}

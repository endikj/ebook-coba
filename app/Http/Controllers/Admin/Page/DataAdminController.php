<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class DataAdminController extends Controller
{
    public function index(Request $request){
        return view('admin.page.dataadmin');
    }

    public function get_user(Request $request)
    {
            $data = User::select('id', 'nama', 'email', 'username', 'role', 'no_hp')
                ->whereIn('role', [1, 2])
                ->get()
                ->map(function ($user) {
                    $user->role = ($user->role == 1) ? 'Super Admin' : 'Admin';
                    return $user;    
                });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" type="button" id="btn-edit" class="btn-edit btn btn-warning rounded me-1 p-1" onClick="edit_data(' . "'" . $row->id . "'" . ')" data-bs-toggle="modal" data-bs-target="#form_modal"><i class="ti ti-pencil fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus btn btn-danger rounded p-1" onClick="delete_data(' . "'" . $row->id . "'" . ')"><i class="ti ti-trash fs-5"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required:',
            'email' => 'required|email:',
            'username' => 'required:',
            'password' => 'required:',
            'role' => 'required:',
            'no_hp' => 'required:',
        ], [
            'nama.required' => 'nama wajib diisi.',
            'email.required' => 'email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'role.required' => 'role wajib diisi.',
            'no_hp.required' => 'no hp wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'no_hp' => $request->no_hp
            ]);
            echo json_encode(['status' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('q');
        $user = User::find($id);

        echo json_encode(['status' => TRUE, 'isi' => $user]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required:',
            'email' => 'required|email:',
            'username' => 'required:',
            'password' => 'nullable:',
            'role' => 'required:',
            'no_hp' => 'required:',
        ], [
            'nama.required' => 'nama wajib diisi.',
            'email.required' => 'email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'username.required' => 'Username wajib diisi.',
            // 'password.required' => 'Password wajib diisi.',
            'role.required' => 'role wajib diisi.',
            'no_hp.required' => 'no hp wajib diisi.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = $request->query('q');
            $user = User::find($id);

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->no_hp = $request->no_hp;

            $user->save();

            echo json_encode(['status' => TRUE]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $user = User::find($id);
        $user->delete();
        echo json_encode(['status' => TRUE]);
    }
}

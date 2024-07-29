<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.page.banner');
    }

    public function get_banner(Request $request)
    {
        $data = Banner::select('id', 'nama', 'foto')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" type="button" id="btn-edit" class="btn-edit btn btn-warning rounded me-1 p-1" onClick="edit_data(' . "'" . $row->id . "'" . ')" data-bs-toggle="modal" data-bs-target="#form_modal"><i class="ti ti-pencil fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus btn btn-danger rounded me-1 p-1" onClick="delete_data(' . "'" . $row->id . "', '" . $row->nama . "'" . ')"><i class="ti ti-trash fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-view" class="btn-lihat btn btn-primary rounded me-1 p-1" onClick="view_data(' . "'" . $row->id . "', '" . $row->nama . "'" . ')"><i class="ti ti-photo fs-5"></i></a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'nama wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'foto.image' => ' Berkas harus berupa gambar',
            'foto.mimes' => ' Format gambar yang diperbolehkan: jpeg,png,jpg,gif',
            'foto.max' => ' Ukuran gambar tidak boleh melebihi 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            // if ($request->hasFile('foto')) {
            //     $file = $request->file('foto');
            //     $filename = time() . '.' . $file->extension();
            //     $path = 'uploads/banners/' . Str::title($request->nama);
            //     $file->move(public_path($path), $filename);
            // }
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $nama = $request->nama;
                $filename = Str::slug($nama) . '_' . time() . '.' . $file->extension();
                $path = 'uploads/banners/';
                $file->move(public_path($path), $filename);
            }

            Banner::create([
                'nama' => $request->nama,
                'foto' => $filename,
            ]);
            echo json_encode(['status' => TRUE]);
        }
    }

    public function get_foto($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $fotoUrl = asset('uploads/banners/' . $banner->foto);
        return response()->json(['foto_url' => $fotoUrl]);
    }

    public function edit(Request $request)
    {
        $id = $request->input('q');
        $banner = Banner::find($id);

        echo json_encode(['status' => TRUE, 'isi' => $banner]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required:',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'nama wajib diisi.',
            'foto.image' => 'Berkas harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg,png,jpg,gif.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = $request->query('q');
            $banner = Banner::find($id);

            $banner->nama = $request->nama;

            if ($request->hasFile('foto')) {
                $oldFilename = $banner->foto;
                if ($oldFilename) {
                    $filePath = public_path('uploads/banners/' . $oldFilename);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                $file = $request->file('foto');
                $nama = $request->nama;
                $filename = Str::slug($nama) . '_' . time() . '.' . $file->extension();
                $path = 'uploads/banners/';
                $file->move(public_path($path), $filename);
                $banner->foto = $filename;
            }

            $banner->save();

            echo json_encode(['status' => TRUE]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $banner = Banner::find($id);

        $filename = $banner->foto;
        if ($filename) {
            $filePath = public_path('uploads/banners/' . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $banner->delete();
        echo json_encode(['status' => TRUE]);
    }
}

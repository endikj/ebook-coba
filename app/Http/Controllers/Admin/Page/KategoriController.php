<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(){
        return view('admin.page.kategori');
    }

    public function get_kategori(Request $request)
    {
            $data = Kategori::select('id', 'kategori')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" type="button" id="btn-edit" class="btn-edit btn btn-warning rounded me-1 p-1" onClick="edit_data(' . "'" . $row->id . "'" . ')" data-bs-toggle="modal" data-bs-target="#form_modal"><i class="ti ti-pencil fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus btn btn-danger rounded p-1" onClick="delete_data(' . "'" . $row->id . "', '" . $row->kategori . "'" . ')"><i class="ti ti-trash fs-5"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required:',
        ], [
            'kategori.required' => 'kategori wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            Kategori::create([
                'kategori' => $request->kategori,
            ]);
            echo json_encode(['status' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('q');
        $kategori = Kategori::find($id);

        echo json_encode(['status' => TRUE, 'isi' => $kategori]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required:',
        ], [
            'kategori.required' => 'kategori wajib diisi.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = $request->query('q');
            $kategori = Kategori::find($id);

            $kategori->kategori = $request->kategori;

            $kategori->save();

            echo json_encode(['status' => TRUE]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $kategori = Kategori::find($id);
        $kategori->delete();
        echo json_encode(['status' => TRUE]);
    }
}

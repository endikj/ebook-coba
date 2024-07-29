<?php

namespace App\Http\Controllers\Admin\Page\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UlasanController extends Controller
{
    public function index(){
        return view('admin.page.laporan.ulasan');
    }

    public function get_ulasan(Request $request)
    {
        $ulasan = Ulasan::select('ulasans.id', 'ulasans.id_user', 'ulasans.id_ebook', 'ulasans.komentar', 'ulasans.penilaian', 'ulasans.created_at', 'users.nama', 'ebooks.judul')
        ->join('users', 'users.id', '=', 'ulasans.id_user')
        ->join('ebooks', 'ebooks.id', '=', 'ulasans.id_ebook')
        ->get();

            return Datatables::of($ulasan)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus btn btn-danger rounded p-1" onClick="delete_data(' . "'" . $row->id . "'" . ')"><i class="ti ti-trash fs-5"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $ulasan = Ulasan::find($id);
        $ulasan->delete();
        echo json_encode(['status' => TRUE]);
    }
}

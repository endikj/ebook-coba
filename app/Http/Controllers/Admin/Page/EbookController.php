<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        return view('admin.page.ebook', compact('kategoris'));
    }

    public function get_ebook(Request $request)
    {
        $data = Ebook::select('ebooks.id', 'ebooks.judul', 'ebooks.id_kategori', 'ebooks.pengarang', 'ebooks.tanggal', 'ebooks.rekomendasi', 'ebooks.publish', 'kategoris.kategori')
            ->leftJoin('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" type="button" id="btn-edit" class="btn-edit btn btn-warning rounded me-1 p-1" onClick="edit_data(' . "'" . $row->id . "'" . ')" data-bs-toggle="modal" data-bs-target="#form_modal"><i class="ti ti-pencil fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus btn btn-danger rounded me-1 p-1" onClick="delete_data(' . "'" . $row->id . "', '" . $row->judul . "'" . ')"><i class="ti ti-trash fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-view-cover" class="btn-lihat btn btn-primary rounded me-1 p-1" onClick="view_cover(' . "'" . $row->id . "', '" . $row->judul . "'" . ')"><i class="ti ti-photo fs-5"></i></a>
                        <a href="javascript:void(0)" type="button" id="btn-view-ebook" class="btn-lihat btn btn-primary rounded me-1 p-1" onClick="view_ebook(' . "'" . $row->id . "', '" . $row->judul . "'" . ')"><i class="ti ti-book fs-5"></i></a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'publish' . 'rekomendasi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'required|mimes:pdf',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'cover.required' => 'Cover wajib diisi',
            'cover.image' => 'Berkas harus berupa gambar',
            'cover.mimes' => 'Format gambar yang diperbolehkan: jpeg,png,jpg,gif',
            'file.required' => 'File wajib diisi',
            'file.mimes' => 'Format file yang diperbolehkan adalah pdf',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            if ($request->hasFile('cover')) {
                $cover = $request->file('cover');
                $judul = $request->judul;

                $judulCover = explode(' ', $judul);
                $numCover = min(3, count($judulCover));
                $selectedJudul = array_slice($judulCover, 0, $numCover);
                $selectedWordsJudul = implode(' ', $selectedJudul);

                $covername = Str::slug($selectedWordsJudul) . '_' . time() . '.' . $cover->extension();
                $path = 'uploads/covers/';
                $cover->move(public_path($path), $covername);
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $judul = $request->judul;

                $judulFile = explode(' ', $judul);
                $numFile = min(3, count($judulFile));
                $selectedFile = array_slice($judulFile, 0, $numFile);
                $selectedWordsFile = implode(' ', $selectedFile);

                $filename = Str::slug($selectedWordsFile) . '_' . time() . '.' . $file->extension();
                $pathfile = 'uploads/files/';
                $file->move(public_path($pathfile), $filename);
            }

            Ebook::create([
                'judul' => $request->judul,
                'id_kategori' => $request->kategori,
                'pengarang' => $request->pengarang,
                'tentang_pengarang' => $request->tentang_pengarang,
                'deskripsi' => $request->deskripsi,
                'halaman' => $request->halaman,
                'sumber' => $request->sumber,
                'penerbit' => $request->penerbit,
                'bahasa' => $request->bahasa,
                'isbn' => $request->isbn,
                'tanggal' => $request->tanggal,
                'rekomendasi' => $request->rekomendasi == '1' ? true : false,
                'publish' => $request->publish == '1' ? true : false,
                'cover' => $covername,
                'file' => $filename,
            ]);

            echo json_encode(['status' => TRUE]);
        }
    }

    public function get_foto($id)
    {
        $ebook = Ebook::find($id);
        if (!$ebook) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
        $fotoUrl = asset('uploads/covers/' . $ebook->cover);
        return response()->json(['foto_url' => $fotoUrl]);
    }

    public function get_file($id)
    {
        $ebook = Ebook::find($id);
        if (!$ebook) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
        $fileUrl = asset('uploads/files/' . $ebook->file);
        return response()->json(['file_url' => $fileUrl]);
    }

    public function publish(Request $request, $id)
    {
        $ebook = Ebook::find($id);
        // $ebook->publish = !$ebook->publish;
        $ebook->publish = $request->input('publish');
        $ebook->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }

    public function rekomendasi(Request $request, $id)
    {
        $ebook = Ebook::find($id);
        // $ebook->rekomendasi = !$ebook->rekomendasi;
        $ebook->rekomendasi = $request->input('rekomendasi');
        $ebook->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }

    public function edit(Request $request)
    {
        $id = $request->input('q');
        $ebook = Ebook::where('id', $id)->with('kategori')->first();

        return response()->json(['status' => TRUE, 'isi' => $ebook]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'kategori' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'mimes:pdf',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'cover.image' => 'Berkas harus berupa gambar',
            'cover.mimes' => 'Format gambar yang diperbolehkan: jpeg,png,jpg,gif',
            'file.mimes' => 'Format file yang diperbolehkan adalah pdf',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = $request->query('q');
            $ebook = Ebook::find($id);

            $ebook->judul = $request->judul;
            $ebook->id_kategori = $request->kategori;
            $ebook->pengarang = $request->pengarang;
            $ebook->tentang_pengarang = $request->tentang_pengarang;
            $ebook->deskripsi = $request->deskripsi;
            $ebook->halaman = $request->halaman;
            $ebook->sumber = $request->sumber;
            $ebook->penerbit = $request->penerbit;
            $ebook->bahasa = $request->bahasa;
            $ebook->isbn = $request->isbn;
            $ebook->tanggal = $request->tanggal;
            $ebook->rekomendasi = $request->rekomendasi == '1' ? true : false;
            $ebook->publish = $request->publish == '1' ? true : false;

            if ($request->hasFile('cover')) {
                $oldCover = $ebook->cover;
                if ($oldCover) {
                    $coverPath = public_path('uploads/covers/' . $oldCover);
                    if (file_exists($coverPath)) {
                        unlink($coverPath);
                    }
                }

                $cover = $request->file('cover');
                $judul = $request->judul;

                $judulCover = explode(' ', $judul);
                $numCover = min(3, count($judulCover));
                $selectedJudul = array_slice($judulCover, 0, $numCover);
                $selectedWordsJudul = implode(' ', $selectedJudul);

                $covername = Str::slug($selectedWordsJudul) . '_' . time() . '.' . $cover->extension();
                $path = 'uploads/covers/';
                $cover->move(public_path($path), $covername);
            }

            if ($request->hasFile('file')) {
                $oldFile = $ebook->file;
                if ($oldFile) {
                    $filePath = public_path('uploads/files/' . $oldFile);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                $file = $request->file('file');
                $judul = $request->judul;

                $judulFile = explode(' ', $judul);
                $numFile = min(3, count($judulFile));
                $selectedFile = array_slice($judulFile, 0, $numFile);
                $selectedWordsFile = implode(' ', $selectedFile);

                $filename = Str::slug($selectedWordsFile) . '_' . time() . '.' . $file->extension();
                $pathfile = 'uploads/files/';
                $file->move(public_path($pathfile), $filename);
            }

            $ebook->save();
            echo json_encode(['status' => TRUE]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $ebook = Ebook::find($id);

        $covername = $ebook->cover;
        if ($covername) {
            $coverPath = public_path('uploads/covers/' . $covername);
            if (file_exists($coverPath)) {
                unlink($coverPath);
            }
        }
        $filename = $ebook->file;
        if ($filename) {
            $filePath = public_path('uploads/files/' . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $ebook->delete();
        echo json_encode(['status' => TRUE]);
    }
}

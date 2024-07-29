<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DetailEbookController extends Controller
{
    public function index($id)
    {
        $id_detail = Crypt::decrypt($id);
        $detailebook = Ebook::where('id', $id_detail)->first();

        $ulasan = Ulasan::select('ulasans.id_user', 'ulasans.id_ebook', 'ulasans.komentar', 'ulasans.penilaian', 'users.nama')
            ->join('users', 'users.id', '=', 'ulasans.id_user')
            ->where('ulasans.id_ebook', $id_detail)
            ->get();

        $averageRating = $ulasan->avg('penilaian');
        return view('pembaca.detailebook', compact('detailebook', 'ulasan', 'averageRating'));
    }

    public function baca($id)
    {
        $ebook = Ebook::find($id);
        if (!$ebook) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
        $fileUrl = asset('uploads/files/' . $ebook->file);
        return response()->json(['file_url' => $fileUrl]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'penilaian' => 'required',
            'id_ebook' => 'required'
        ], [
            'penilaian.required' => 'silakan isi',
        ]);

        // Return validation errors if any
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()]);
        // }

        // Check if the user has already reviewed the eBook
        $existingReview = Ulasan::where('id_user', Auth::user()->id)
            ->where('id_ebook', $request->id_ebook)
            ->first();

        // If review exists, return an error message
        if ($existingReview) {
            return response()->json(['errors' => ['review' => 'Anda sudah memberikan penilaian']]);
        }

        // Create a new review
        Ulasan::create([
            'id_user' => Auth::user()->id,
            'id_ebook' => $request->id_ebook,
            'komentar' => $request->komentar,
            'penilaian' => $request->penilaian,
        ]);

        // Return success response
        return response()->json(['status' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Ebook;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PembacaEbookController extends Controller
{
    // public function index(){
    //     return view('index');
    // }
    public function index()
    {
        $today = Carbon::now()->translatedFormat('l,j F Y');
        // @dd($today);
        $banner = Banner::select('foto')->get();

        $ebook = Ebook::with('ulasan')
            ->select('id', 'cover', 'judul', 'deskripsi', 'jumlah_baca', 'tanggal', 'publish', 'rekomendasi')
            ->orderBy('tanggal', 'desc')
            ->latest()
            ->paginate(8);
        $ebookterpopuler = Ebook::with('ulasan')
            ->select('id', 'cover', 'judul', 'deskripsi', 'jumlah_baca', 'tanggal', 'publish', 'rekomendasi')
            ->orderBy('jumlah_baca', 'desc')
            ->paginate(8);
        $koleksibanyuwangi = Ebook::select('id', 'cover', 'judul', 'deskripsi', 'jumlah_baca', 'tanggal', 'publish', 'rekomendasi', 'id_kategori')
            ->orderBy('tanggal', 'desc')
            ->latest()
            ->paginate(8);
        $kategori = Kategori::select('id', 'kategori')->get();

        $ebook->each(function ($ebook) {
            $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        });
        $ebookterpopuler->each(function ($ebook) {
            $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        });
        $koleksibanyuwangi->each(function ($ebook) {
            $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        });

        // $ebookterbaru->each(function ($ebook) {
        //     $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        // });
        return view('pembaca.home', compact('today', 'banner', 'ebook', 'ebookterpopuler', 'koleksibanyuwangi', 'kategori'));
    }

    public function jumlahBaca(Request $request, $id)
    {
        $ebook = Ebook::find($id);
        if ($ebook) {
            $ebook->jumlah_baca += 1;
            $ebook->save();

            return response()->json(['jumlah_baca' => $ebook->jumlah_baca]);
        }
        return response()->json(['error' => 'Ebook not found'], 404);
    }
}

<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Kategori;

class CariEbookController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $ebook = Ebook::with('ulasan')
            ->select('id', 'cover', 'judul', 'deskripsi', 'jumlah_baca', 'tanggal', 'publish', 'rekomendasi')
            ->orderBy('tanggal', 'desc')
            ->latest()
            ->paginate(8);

        $ebook->each(function ($ebook) {
            $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        });
        return view('pembaca.caribuku', compact('kategoris', 'ebook'));
    }

    // Contoh penanganan permintaan pencarian di server (Laravel)
    public function search(Request $request)
    {
        $kategoris = Kategori::all();

        $judul = $request->input('search');
        $id_kategori = $request->input('id_kategori');

        $ebook = Ebook::where('judul', 'like', "%" . $judul . "%")->where('id_kategori', 'like', "%" . $id_kategori . "%")->paginate(5);
        // @dd($ebook);
        return view('pembaca.caribuku', compact('ebook', 'kategoris'));

        // Lakukan pencarian berdasarkan query dan kategori
        // Anda perlu mengembalikan hasil pencarian sebagai respons JSON
    }
}

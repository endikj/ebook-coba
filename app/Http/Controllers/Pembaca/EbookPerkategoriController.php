<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Kategori;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class EbookPerkategoriController extends Controller
{
    public function index(Request $request)
    {
        $id_kategori = $request->input('id_kategori');
        $kategori = Kategori::where('id', $id_kategori)->first();
        $ebook = Ebook::with('ulasan')->where('id_kategori', $id_kategori)
            ->select('id', 'cover', 'judul', 'deskripsi', 'jumlah_baca', 'tanggal', 'publish', 'rekomendasi', 'id_kategori')
            ->orderBy('tanggal', 'desc')
            ->latest()
            ->get();

        $ebook->each(function ($ebook) {
            $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        });
        return view('pembaca.ebookperkategori', compact('ebook', 'kategori'));
    }
}

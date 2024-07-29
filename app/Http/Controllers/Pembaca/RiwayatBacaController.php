<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use App\Models\RiwayatBaca;
use App\Models\Ebook;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RiwayatBacaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $riwayatBaca = Ebook::with('riwayatbaca')
            ->whereHas('riwayatbaca', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })
            ->select('id', 'cover', 'judul', 'deskripsi', 'jumlah_baca', 'tanggal', 'publish', 'rekomendasi')
            ->orderBy('tanggal', 'desc')
            ->latest()
            ->paginate(8);

        $riwayatBaca->each(function ($ebook) {
            $ebook->average_rating = $ebook->ulasan->avg('penilaian');
        });

        return view('pembaca.riwayatbaca', compact('riwayatBaca'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ebook' => 'required|exists:ebooks,id',
        ]);

        $riwayatbaca = new RiwayatBaca();
        $riwayatbaca->id_user = Auth::id();
        $riwayatbaca->id_ebook = $request->id_ebook;
        $riwayatbaca->save();

        return response()->json(['success' => 'Riwayat baca telah disimpan']);
    }
}

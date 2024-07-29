<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'id_kategori',
        'pengarang',
        'tentang_pengarang',
        'deskripsi',
        'halaman',
        'sumber',
        'penerbit',
        'bahasa',
        'isbn',
        'tanggal',
        'rekomendasi',
        'publish',
        'cover',
        'file',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_ebook');
    }

    public function riwayatbaca()
    {
        return $this->hasMany(RiwayatBaca::class, 'id_ebook');
    }
}

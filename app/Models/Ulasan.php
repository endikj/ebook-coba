<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    protected $fillable = [
        'komentar',
        'penilaian',
        'id_ebook',
        'id_user',
        'created_at',
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'id_ebook');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

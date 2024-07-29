<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatBaca extends Model
{
    use HasFactory;
    protected $table = 'riwayatbacas';
    protected $fillable = ['id_user', 'id_ebook'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'id_ebook');
    }
}

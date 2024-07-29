<?php

namespace App\Http\Controllers\Admin\Page\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JumlahPembacaController extends Controller
{
    public function index(){
        return view('admin.page.laporan.jumlahpembaca');
    }
}

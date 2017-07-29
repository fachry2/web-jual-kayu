<?php

namespace App\Http\Controllers\Pembeli;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembeliController extends Controller
{

    public function index(){
        return view('pembeli.index');
    }

    public function produk(){
        return "PRODUK PEMBELI";
    }
}

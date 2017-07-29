<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        //function halaman yang digunakan hanya untuk yang sudah registrasi middleware 'auth'
//        $this->middleware('auth');
//        $this->middleware('rule:Admin');

    }

    public function index(){
        return view('admin.index');
    }
}

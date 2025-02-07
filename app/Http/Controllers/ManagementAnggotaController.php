<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementAnggotaController extends Controller
{
    function index() {
        $kosong = [];
        return view('admin.anggota')->with('title','Management Anggota')->with('kosong',$kosong);
    }
}

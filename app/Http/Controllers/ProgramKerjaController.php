<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramKerjaController extends Controller
{
    function index(){
        $kosong = [];
        return view('pengurus.programKerja')->with('title','Management Program Kerja')->with('kosong',$kosong);
    }
}

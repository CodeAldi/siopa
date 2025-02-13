<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $pengurus = User::where('role','pengurus')->count();
        $anggota = User::where('role','anggota')->count();
        $masyarakat = User::where('role','pengurus')->count();
        return view('home')->with('title','Home')->with('pengurus',$pengurus)->with('anggota', $anggota)->with('masyarakat', $masyarakat);
    }
}

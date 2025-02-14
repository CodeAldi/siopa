<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\ProgramKerja;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        if (Auth()->user()->role == UserRole::admin) {
            $pengurus = User::where('role','pengurus')->count();
            $anggota = User::where('role','anggota')->count();
            $masyarakat = User::where('role','pengurus')->count();
            return view('home')->with('title','Home')->with('pengurus',$pengurus)->with('anggota', $anggota)->with('masyarakat', $masyarakat);
        } elseif (Auth()->user()->role == UserRole::pengurus) {
            $kegiatan = ProgramKerja::all();
            $event = [];
            foreach ($kegiatan as $key => $value) {
                $event[$key]['title'] = $value->judul;
                $event[$key]['start'] = $value->tanggal_kegiatan; 
            }
            return view('home')->with('title', 'Home')->with('event',$event);
        } else {
            dd(Auth()->user()->role);
        }
        
    }
}

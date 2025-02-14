<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Keuangan;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        if (Auth()->user()->role == UserRole::admin) {
            $pengurus = User::where('role','pengurus')->count();
            $anggota = User::where('role','anggota')->count();
            $masyarakat = User::where('role','masyarakat')->count();
            return view('home')->with('title','Home')->with('pengurus',$pengurus)->with('anggota', $anggota)->with('masyarakat', $masyarakat);
        } else {
            $keuangan = Keuangan::all();
            $total = 0;
            $masuk = 0;
            $keluar = 0;
            foreach ($keuangan as $key => $value) {
                if ($value->kategori == 'masuk') {
                    $masuk = $masuk + $value->nominal;
                } else {
                    $keluar = $keluar + $value->nominal;
                }
            }
            $total = $masuk - $keluar;
            $kegiatan = ProgramKerja::all();
            $event = [];
            foreach ($kegiatan as $key => $value) {
                $event[$key]['title'] = $value->judul;
                $event[$key]['start'] = $value->tanggal_kegiatan; 
            }
            return view('home')->with('title', 'Home')->with('event',$event)->with('total',$total);
        }
        
    }
}

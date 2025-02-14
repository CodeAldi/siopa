<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    function index() {
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
        return view('pengurus.keuangan',[
            'masuk' => $masuk,
            'keluar' => $keluar,
            'total' => $total,
        ])->with('title','Keuangan')->with('keuangan',$keuangan);
    }
    function store(Request $request) {
        $keuangan = new Keuangan();
        $keuangan->judul = $request->judul;
        $keuangan->keterangan = $request->keterangan;
        $keuangan->tanggal = $request->tanggal;
        $keuangan->kategori = $request->kategori;
        $keuangan->nominal = $request->nominal;
        $keuangan->save();
        return back();
    }
}

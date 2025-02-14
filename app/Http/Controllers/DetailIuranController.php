<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Keuangan;
use App\Models\DetailIuran;
use Illuminate\Http\Request;

class DetailIuranController extends Controller
{
    function index(Request $request){
        $detail = DetailIuran::where('iuran_id',$request->id)->get();
        return view('pengurus.detailiuran')->with('title', 'Detail Iuran')->with('detail',$detail);
        
    }
    function setujui(Request $request) {
        $detail = DetailIuran::find($request->id);
        $detail->status = true;
        $detail->save();

        $keuangan = new Keuangan();
        $keuangan->judul = 'anggota bayar uang kas';
        $keuangan->keterangan = 'Pembayaran iuran kas anggota oleh : ' . $detail->anggota->name;
        $keuangan->tanggal = now();
        $keuangan->kategori = 'masuk';
        $keuangan->nominal = $detail->iuran->nominal;
        $keuangan->save();
        return back();
    }
}

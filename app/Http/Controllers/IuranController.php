<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    function index() {
        $iuran = Iuran::all();
        return view('pengurus.iuran')->with('title','Management Iuran')->with('iuran',$iuran);
    }
    function store(Request $request) {
        $iuran = new Iuran();
        $iuran->judul = $request->judul;
        $iuran->rekening = $request->rekening;
        $iuran->nama = $request->nama;
        $iuran->jenis = $request->jenis;
        $iuran->tanggal = $request->bulan;
        $iuran->nominal = $request->nominal;
        $iuran->save();
        return back();
    }
    function update(Request $request){
        $iuran = Iuran::find($request->id);
        $iuran->judul = $request->judul;
        $iuran->rekening = $request->rekening;
        $iuran->nama = $request->nama;
        $iuran->jenis = $request->jenis;
        $iuran->tanggal = $request->bulan;
        $iuran->nominal = $request->nominal;
        $iuran->save();
        return back();
    }
    function delete(Request $request) {
        $iuran = Iuran::find($request->id);
        $iuran->delete();
        return back();
    }
}

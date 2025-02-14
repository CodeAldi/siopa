<?php

namespace App\Http\Controllers;

use App\Models\DetailIuran;
use App\Models\User;
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
        $anggota = User::where('role','anggota')->get();
        if (count($anggota) > 0) {
            foreach ($anggota as $key => $value) {
                $detail = new DetailIuran();
                $detail->iuran_id = $iuran->id;
                $detail->anggota_id = $value->id;
                $detail->save();
            }
        }
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

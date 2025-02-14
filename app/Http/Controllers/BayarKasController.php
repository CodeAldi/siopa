<?php

namespace App\Http\Controllers;

use App\Models\DetailIuran;
use Illuminate\Http\Request;

class BayarKasController extends Controller
{
    function index() {
        $tagihan = DetailIuran::where('anggota_id',Auth()->user()->id)->whereNull('bukti_transfer')->get();
        return view('anggota.bayarkas')->with('title','Bayar Uang Kas')->with('tagihan',$tagihan);
    }
    function store(Request $request) {
        $tagihan = DetailIuran::find($request->id);
        $bukti = $request->file('bukti');
        $buktinama = $tagihan->anggota->name . $tagihan->iuran->judul . '.' . $bukti->getClientOriginalExtension();
        $url = $bukti->storeAs('public/bukti', $buktinama);
        $tagihan->bukti_transfer = $url;
        $tagihan->save();
        return back();
    }
}

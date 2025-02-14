<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    function index() {
        $pengumuman = Pengumuman::all();
        return view('pengurus.pengumuman')->with('title','Management Pengumuman')->with('pengumuman',$pengumuman);
    }
    function store(Request $request) {
        $pengumuman = new Pengumuman();
        $pengumuman->judul = $request->judul;
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->lokasi = $request->lokasi;
        $pengumuman->isi = $request->isi;
        $pengumuman->save();
        return back();
    }
    function update(Request $request) {
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->judul = $request->judul;
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->lokasi = $request->lokasi;
        $pengumuman->isi = $request->isi;
        $pengumuman->save();
        return back();
    }
    function delete(Request $request) {
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->delete();
        return back();
    }
}

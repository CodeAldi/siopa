<?php

namespace App\Http\Controllers;

use App\Models\Lpj;
use App\Models\Keuangan;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class LpjController extends Controller
{
    function index(){
        $kegiatan = ProgramKerja::whereDoesntHave('lpj')->get();
        $lpj = Lpj::all();
        return view('pengurus.lpj')->with('title','Laporan Pertanggung Jawaban Kegiatan')->with('kegiatan',$kegiatan)->with('lpj',$lpj);
    }
    function store(Request $request) {
        $lpj = new Lpj();
        $lpj->kegiatan_id = $request->kegiatan_id;
        $lpj->total_pengeluaran = $request->total_pengeluaran;
        $lpj->isi = $request->isi;
        $lpj->save();

        $keuangan = new Keuangan();
        $keuangan->judul = 'LPJ kegiatan : ' . $lpj->kegiatan->judul;
        $keuangan->keterangan = $lpj->isi;
        $keuangan->tanggal = now();
        $keuangan->kategori = 'keluar';
        $keuangan->nominal = $lpj->total_pengeluaran;
        $keuangan->save();
        return back();
    }
}

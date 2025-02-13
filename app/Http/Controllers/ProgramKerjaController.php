<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class ProgramKerjaController extends Controller
{
    function index(){
        $programKerja = ProgramKerja::all();
        $penanggungJawab = User::whereNot('role','admin')->whereNot('role', 'masyarakat')->get();
        return view('pengurus.programKerja')->with('title','Management Program Kerja')->with('penanggungJawab',$penanggungJawab)->with('programkerja',$programKerja);
    }
    function store(Request $request) {
        $programKerja = new ProgramKerja();
        $programKerja->penanggung_jawab = $request->penanggung_jawab;
        $programKerja->judul = $request->judul;
        $programKerja->kategori = $request->kategori;
        $programKerja->lokasi = $request->lokasi;
        $programKerja->tanggal_kegiatan = $request->tanggal_kegiatan;
        $programKerja->lama_kegiatan = $request->lama_kegiatan;
        $programKerja->deskrispsi = $request->deskrispsi;
        $programKerja->save();
        return back();
    }
}

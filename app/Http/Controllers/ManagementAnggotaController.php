<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementAnggotaController extends Controller
{
    function index() {
        $anggota = User::where('role',UserRole::anggota)->get();
        // dd($anggota);
        return view('admin.anggota')->with('title','Management Anggota')->with('anggota',$anggota);
    }
    function store(Request $request) {
        $anggota = new User();
        $anggota->name = $request->name;
        $anggota->email = $request->email;
        $anggota->password = bcrypt($request->password);
        $anggota->nik = $request->nik;
        $anggota->nohp = $request->nohp;
        $anggota->alamat = $request->alamat;
        $anggota->tempat_lahir = $request->tempat_lahir;
        $anggota->tanggal_lahir = $request->tanggal_lahir;
        $anggota->role = UserRole::anggota;
        $anggota->save();
        return back();
    }
    function update(Request $request) {
        $user = User::find($request->id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->save();
        return back();
    }
    function delete(Request$request) {
        $user = User::find($request->id);
        $user->delete();
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class ManagementPengurusController extends Controller
{
    function index()
    {
        $pengurus = User::where('role', UserRole::pengurus)->get();
        return view('admin.pengurus')->with('title', 'Management Pengurus')->with('pengurus', $pengurus);
    }
    function store(Request $request)
    {
        $pengurus = new User();
        $pengurus->name = $request->name;
        $pengurus->email = $request->email;
        $pengurus->password = bcrypt($request->password);
        $pengurus->nik = $request->nik;
        $pengurus->nohp = $request->nohp;
        $pengurus->alamat = $request->alamat;
        $pengurus->tempat_lahir = $request->tempat_lahir;
        $pengurus->tanggal_lahir = $request->tanggal_lahir;
        $pengurus->role = UserRole::pengurus;
        $pengurus->save();
        return back();
    }
    function update(Request $request)
    {
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
    function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return back();
    }
}

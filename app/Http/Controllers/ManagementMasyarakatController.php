<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class ManagementMasyarakatController extends Controller
{
    function index()
    {
        $masyarakat = User::where('role', UserRole::masyarakat)->get();
        // dd($masyarakat);
        return view('admin.masyarakat')->with('title', 'Management Masyarakat')->with('masyarakat', $masyarakat);
    }
    function store(Request $request)
    {
        $masyarakat = new User();
        $masyarakat->name = $request->name;
        $masyarakat->email = $request->email;
        $masyarakat->password = bcrypt($request->password);
        $masyarakat->nik = $request->nik;
        $masyarakat->nohp = $request->nohp;
        $masyarakat->alamat = $request->alamat;
        $masyarakat->tempat_lahir = $request->tempat_lahir;
        $masyarakat->tanggal_lahir = $request->tanggal_lahir;
        $masyarakat->role = UserRole::masyarakat;
        $masyarakat->save();
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

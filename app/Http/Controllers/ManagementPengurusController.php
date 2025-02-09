<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementPengurusController extends Controller
{
    function index() {
        $kosong = [];
        return view('admin.pengurus')->with('title', 'Management Pengurus')->with('kosong', $kosong);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementMasyarakatController extends Controller
{
    function index()
    {
        $kosong = [];
        return view('admin.masyarakat')->with('title', 'Management Masyarakat')->with('kosong', $kosong);
    }
}

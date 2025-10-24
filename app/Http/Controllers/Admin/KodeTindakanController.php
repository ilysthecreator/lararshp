<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;
use Illuminate\Http\Request;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $kodeTindakan = KodeTindakan::all();
        
        return view('admin.kode-tindakan.index', compact('kodeTindakan'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        // Ambil data dengan hitung jumlah pets
        $pemilik = Pemilik::withCount('pets')->get();
        
        return view('admin.pemilik.index', compact('pemilik'));
    }
}
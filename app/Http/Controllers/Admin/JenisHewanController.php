<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        // Metode 1: Ambil semua data
        $jenisHewan = JenisHewan::all();
        
        // Metode 2: Ambil data dengan kolom tertentu (seperti contoh modul)
        // $jenisHewan = JenisHewan::select('id', 'nama_jenis', 'deskripsi')->get();
        
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }
}
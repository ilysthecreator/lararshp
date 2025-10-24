<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        // Ambil semua data dengan relasi jenisHewan
        $rasHewan = RasHewan::with('jenisHewan')->get();
        
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }
}
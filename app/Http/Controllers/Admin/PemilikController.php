<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik; // <-- Pastikan Model Pemilik di-import [cite: 275]

class PemilikController extends Controller // [cite: 278]
{
    public function index() // [cite: 282]
    {
        $pemilik = Pemilik::with('user')->get();

        return view('admin.pemilik.index', compact('pemilik')); // [cite: 288]
    }
}
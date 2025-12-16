<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pet::with('pemilik.user', 'jenisHewan', 'rasHewan')
                    ->orderBy('idpet', 'desc') 
                    ->paginate(10);
                    
        return view('perawat.pasien.index', compact('pasien'));
    }
}
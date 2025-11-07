<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $user = Auth::user();
        $pets = Pet::where('idpemilik', $user->pemilik->idpemilik)
                    ->with('rasHewan.jenisHewan')
                    ->get();

        return view('pemilik.dashboard', compact('pets'));
    }
}
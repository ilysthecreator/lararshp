<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DashboardController extends Controller
{
    public function index()
    {
        $recentRekamMedis = RekamMedis::with('pet.pemilik.user')
                                      ->latest('created_at')
                                      ->take(5)
                                      ->get();
        return view('dokter.dashboard', compact('recentRekamMedis'));
    }
}
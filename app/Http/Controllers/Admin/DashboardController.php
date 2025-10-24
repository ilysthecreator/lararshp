<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect ke dashboard jika sudah login
        if (auth()->check()) {
            // Hitung statistik
            $stats = [
                'jenis_hewan' => JenisHewan::count(),
                'pet' => Pet::count(),
                'pemilik' => Pemilik::count(),
                'user' => User::count(),
            ];

            return view('admin.dashboard', compact('stats'));
        }
        
        return redirect('login');
    }
}
    
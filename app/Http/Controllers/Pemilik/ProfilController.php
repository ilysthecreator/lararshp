<?php
namespace App\Http\Controllers\Pemilik;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $pets = Pet::where('idpemilik', $pemilik->idpemilik)
                    ->with(['rasHewan.jenisHewan'])
                    ->get();

        return view('pemilik.profil.index', compact('user', 'pemilik', 'pets'));
    }
}
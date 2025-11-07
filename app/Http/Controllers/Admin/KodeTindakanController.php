<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $kodeTindakan = KodeTindakan::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode-tindakan.index', compact('kodeTindakan'));
    }
}
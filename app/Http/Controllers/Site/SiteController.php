<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function layanan()
    {
        return view('site.layanan');
    }

    public function kontak()
    {
        return view('site.kontak');
    }

    public function strukturOrganisasi()
    {
        return view('site.struktur');
    }

    public function login()
    {
        return view('site.login');
    }
}
<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisiController extends Controller
{
    public function index() {
        return view('site.visi');
    }
}

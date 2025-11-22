<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function index()
	{
		return redirect()->route('dashboard');
	}
}

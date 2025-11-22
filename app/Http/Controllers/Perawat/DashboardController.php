<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function index()
	{
		return redirect()->route('dashboard');
	}
}

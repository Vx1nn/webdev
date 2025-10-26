<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminDashboardService;

class AdminDashboardController extends Controller
{
    protected AdminDashboardService $service;

    public function __construct(AdminDashboardService $service)
    {
        parent::__construct(); // opsional
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getOverview();
        return view('admin.dashboard', $data);
    }
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::with('roles')->get();
        return view('admin.user.index', compact('data'));
    }
}

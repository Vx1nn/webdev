<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('user')
            ->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->select('user.*', 'role.nama_role')
            ->orderBy('user.iduser', 'asc')
            ->get();

        $roles = Role::all();

        return view('admin.user.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'idrole' => 'required|integer'
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            DB::table('role_user')->insert([
                'iduser' => $user->iduser,
                'idrole' => $validated['idrole'],
                'status' => 1,
            ]);
        });

        return back()->with('success', 'User baru berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => "required|email|unique:user,email,$id,iduser",
            'idrole' => 'required|integer'
        ]);

        DB::transaction(function () use ($validated, $id) {
            User::where('iduser', $id)->update([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
            ]);

            DB::table('role_user')
                ->where('iduser', $id)
                ->update(['idrole' => $validated['idrole']]);
        });

        return back()->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            DB::table('role_user')->where('iduser', $id)->delete();
            User::destroy($id);
        });

        return back()->with('success', 'User berhasil dihapus.');
    }
}

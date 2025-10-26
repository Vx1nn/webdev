<?php
namespace App\Repositories\AdminDashboard;

use App\Models\User;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;

class EloquentDashboardRepository implements DashboardRepositoryInterface
{
    public function totalUsers(): int
    {
        return User::count();
    }

    public function totalPemilik(): int
    {
        return Pemilik::count();
    }

    public function totalPets(): int
    {
        return Pet::count();
    }

    public function totalReservasi(): int
    {
        return TemuDokter::count();
    }

    public function recentReservasi(int $limit = 10)
    {
        return TemuDokter::with(['pet.pemilik.user','roleUser.role'])
            ->orderBy('waktu_daftar', 'desc')
            ->take($limit)
            ->get();
    }

    public function roleCounts(): array
    {
        // join role_user & role
        return DB::table('role')
            ->leftJoin('role_user', 'role.idrole', '=', 'role_user.idrole')
            ->select('role.nama_role', DB::raw('COUNT(role_user.idrole_user) as total'))
            ->groupBy('role.idrole','role.nama_role')
            ->pluck('total','role.nama_role')
            ->toArray();
    }
}

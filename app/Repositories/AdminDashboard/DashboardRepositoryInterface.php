<?php
namespace App\Repositories\AdminDashboard;

interface DashboardRepositoryInterface
{
    public function totalUsers(): int;
    public function totalPemilik(): int;
    public function totalPets(): int;
    public function totalReservasi(): int;
    public function recentReservasi(int $limit = 10);
    public function roleCounts(): array;
}

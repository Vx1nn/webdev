<?php
namespace App\Services;

use App\Repositories\AdminDashboard\DashboardRepositoryInterface;

class AdminDashboardService
{
    protected DashboardRepositoryInterface $repo;

    public function __construct(DashboardRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getOverview(): array
    {
        return [
            'users' => $this->repo->totalUsers(),
            'pemilik' => $this->repo->totalPemilik(),
            'pets' => $this->repo->totalPets(),
            'reservasi' => $this->repo->totalReservasi(),
            'roles' => $this->repo->roleCounts(),
            'recent_reservasi' => $this->repo->recentReservasi(10),
        ];
    }
}

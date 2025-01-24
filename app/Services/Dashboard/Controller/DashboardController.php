<?php

namespace App\Services\Dashboard\Controller;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\Repository\DashboardRepo;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private DashboardRepo $dashboardRepo;

    public function __construct(DashboardRepo $dashboardRepo)
    {
        $this->dashboardRepo = $dashboardRepo;
    }

    public function index()
    {
        // Get data from the repository
        $data = $this->dashboardRepo->index();

        // Extract the values
        $income = $data['income'];
        $expenses = $data['expenses'];
        $revenue = $data['revenue'];
        $profitRate = $data['profitRate'];

        // Pass the data to the view
        return Inertia::render('Frontend/Dashboard', [
            'income' => $income,
            'expenses' => $expenses,
            'revenue' => $revenue,
            'profitRate' => $profitRate,
        ]);
    }
}

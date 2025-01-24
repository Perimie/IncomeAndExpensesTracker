<?php

namespace App\Services\Dashboard\Repository;
use App\Services\Expenses\Expenses;
use App\Services\Income\Income;
use Illuminate\Http\Request;

class DashboardRepo 
{

    public function index()
    {
        
        $income=  Income::sum('amount'); 
        
        $expenses = Expenses::sum('amountOfExpenses');

        $revenue = $income - $expenses;
        
        $profitRate = $income > 0 ? ($revenue / $income) * 100 : 0;

        return([
            'income'=> $income,
            'expenses'=> $expenses,
            'revenue'=> $revenue,
            'profitRate'=> $profitRate
        ]);
    }
    

}

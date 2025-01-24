<?php

namespace App\Services\Income\Controller;

use App\Http\Controllers\Controller;
use App\Services\Income\Repository\IncomeRepo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\Income\Income;

class IncomeController extends Controller
{
  
    private IncomeRepo $incomeRepo;

    public function __construct(IncomeRepo $incomeRepo)
    {
        $this->incomeRepo = $incomeRepo;
    }

    public function index(Request $request)
    {
        $incomes = $this->incomeRepo->index($request, 5);
        $totalIncome = $this->incomeRepo->getTotalAmount();
    
        return Inertia::render('Income/Income', [
            'incomes' => $incomes,
            'totalIncome' => $totalIncome,
        ]);
    }
    


    public function create(Request $request)
    {
       // Save the income
       $this->incomeRepo->create($request);

       return redirect()->route('addIncome')->with('success', 'Income record created successfully!');

    }

    public function edit($id)
    {
        $income= $this->incomeRepo->edit($id);
        return Inertia::render('Income/editIncome', ['income' => $income]);
    }

    public function update(Request $request, $id)
    {
        $this->incomeRepo->update($request, $id);
        return redirect()->route('index')->with('success', 'Income record updated successfully!');
    }
    
    public function destroy($id)
    {
        try {
            $this->incomeRepo->destroy($id);
            return redirect()->route('index')->with('success', 'Income record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete income record: ' . $e->getMessage());
        }
    }
    

}

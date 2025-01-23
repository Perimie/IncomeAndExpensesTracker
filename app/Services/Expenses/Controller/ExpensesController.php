<?php

namespace App\Services\Expenses\Controller;

use App\Http\Controllers\Controller;
use App\Services\Expenses\Repository\ExpensesRepo;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ExpensesController extends Controller
{

    private ExpensesRepo $expensesRepo;

    public function __construct(ExpensesRepo $expensesRepo)
    {
        $this->expensesRepo = $expensesRepo;
    }

    public function index(Request $request)
    {
        $expenses= $this->expensesRepo->index($request);

        return Inertia::render('Expenses/Expenses', ['expenses' => $expenses]);
    }

    public function create(Request $request)
    {
       // Save the Expenses
       $this->expensesRepo->create($request);

       return redirect()->route('addExpenses')->with('success', 'Expense record created successfully!');

    }

    public function edit($id)
    {
        $expense= $this->expensesRepo->edit($id);
        return Inertia::render('Expenses/editExpenses', ['expense' => $expense]);
    }

    public function update(Request $request, $id)
    {
        $this->expensesRepo->update($request, $id);
        return redirect()->route('expenses')->with('success', 'Expense record updated successfully!');
    }
    public function destroy($id)
    {
        try {
            $this->expensesRepo->destroy($id);
            return redirect()->route('expenses')->with('success', 'Expenses record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Expenses record: ' . $e->getMessage());
        }
    }

}

<?php

namespace App\Services\Expenses\Repository;
use App\Services\Expenses\Expenses;
use Illuminate\Http\Request;

class ExpensesRepo 
{

    public function index(Request $request, $perPage = 5)
    {
        return Expenses::query()
            ->when($request->dateOfExpenses, function ($query, $dateOfExpenses) {
                $query->whereDate('dateOfExpenses', $dateOfExpenses);
            })
            ->when($request->sourceOfExpenses, function ($query, $sourceOfExpenses) {
                $query->where('sourceOfExpenses', 'like', "%{$sourceOfExpenses}%");
            })
            ->when($request->amountOfExpenses, function ($query, $amountOfExpenses) {
                $query->where('amountOfExpenses', $amountOfExpenses);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    public function getTotalAmount()
    {
        return Expenses::sum('amountOfExpenses'); 
    }   
  
    public function create(Request $request)
    {
       

       $validateExpenses = $request->validate([
            "dateOfExpenses"=> "required",
            "sourceOfExpenses"=> "required|min:3|max:25",
            "descriptionOfExpenses"=> "required",
            'amountOfExpenses' =>"required|integer",
        ]);


        $expenses = new Expenses();

        $expenses->dateOfExpenses = $validateExpenses['dateOfExpenses'];
        $expenses->sourceOfExpenses = $validateExpenses['sourceOfExpenses'];
        $expenses->descriptionOfExpenses = $validateExpenses['descriptionOfExpenses'];
        $expenses->amountOfExpenses = $validateExpenses['amountOfExpenses'];
        $expenses->save();
        return($expenses);   
        
    }

    public function edit($id)
    {

       return Expenses::findOrFail($id); 
           
    } 
    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            'dateOfExpenses' => 'required|date',
            'sourceOfExpenses' => 'required|string|min:3|max:255',
            'descriptionOfExpenses' => 'required|string|min:3|max:255',
            'amountOfExpenses' => 'required|numeric',
        ]);
    
        
        $expense = Expenses::findOrFail($id);
    
       
        $expense->update($data);
    }
    public function destroy($id)
    {
        $expense = Expenses::findOrFail($id); 
        $expense->delete();
    }

}

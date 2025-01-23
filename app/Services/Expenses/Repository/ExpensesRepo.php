<?php

namespace App\Services\Expenses\Repository;
use App\Services\Expenses\Expenses;
use Illuminate\Http\Request;

class ExpensesRepo 
{

    public function index()
    {
        
        return Expenses::orderBy('created_at', 'desc')->get();
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

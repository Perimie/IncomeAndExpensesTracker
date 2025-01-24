<?php

namespace App\Services\Income\Repository;
use App\Services\Income\Income;
use Inertia\Inertia;
use Illuminate\Http\Request;

class IncomeRepo 
{

    public function index(Request $request, $perPage = 5)
    {
        return Income::query()
            ->when($request->date, function ($query, $date) {
                $query->whereDate('date', $date);
            })
            ->when($request->source, function ($query, $source) {
                $query->where('source', 'like', "%{$source}%");
            })
            ->when($request->amount, function ($query, $amount) {
                $query->where('amount', $amount);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    
    public function getTotalAmount()
    {
        return Income::sum('amount'); 
    }

  
    public function create(Request $request)
    {
       

       $validateIncome = $request->validate([
            "date"=> "required|date",
            "source"=> "required|string|min:3|max:255",
            "description"=> "required|string|min:3|max:255",
            'amount' =>"required|numeric",
        ]);


        $income = new Income();

        $income->date = $validateIncome['date'];
        $income->source = $validateIncome['source'];
        $income->description = $validateIncome['description'];
        $income->amount = $validateIncome['amount'];
        $income->save();
        return($income);   
        
    }

    public function edit($id)
    {

       return Income::findOrFail($id); 
           
    } 
    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            'date' => 'required|date',
            'source' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);
    
        
        $income = Income::findOrFail($id);
    
       
        $income->update($data);
    }
    public function destroy($id)
    {
        $income = Income::findOrFail($id); 
        $income->delete();
    }

}

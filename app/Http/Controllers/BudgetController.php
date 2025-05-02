<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Budget;

class BudgetController extends Controller
{
    //

    public function create()
    {
        $userId = Auth::id();

    // Get all budgets for the user, ordered by date
    $budgets = Budget::where('user_id', $userId)
        ->orderBy('date', 'desc')
        ->get();

    return view('budget.create', compact('budgets'));
    }

    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'budgetamount' => 'required',
        ]);

        $userId = Auth::id();
        $month = str_pad($request->input('month'), 2, '0', STR_PAD_LEFT);
        $year = $request->input('year');
        $date = "$year-$month-01";
        $budgetamount = $request->input('budgetamount'); 
        Budget::create(
            [
                'user_id' => $userId,

                'date' => $date,

            'budgetamount' => $budgetamount,
                
            ],
            
        );

        return redirect()->back()->with('success', 'Budget saved successfully.');
    }
//     public function edit($id)
// {


//     // Find the budget by ID
//     $budget = Budget::findOrFail($id);

//     // Ensure the user can only edit their own budgets
//     $this->authorize('update', $budget);

//     return view('budget.edit', compact('budget'));
// }


public function edit($id)
    {
        $budget = Budget::findOrFail($id);

        // Authorization using policy
        $this->authorize('update', $budget);

        return view('budget.edit', compact('budget'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'budgetamount' => 'required|numeric',
        ]);

        $budget = Budget::findOrFail($id);
        $this->authorize('update', $budget);

        $month = str_pad($request->input('month'), 2, '0', STR_PAD_LEFT);
        $year = $request->input('year');
        $date = "$year-$month-01";

        $budget->update([
            'date' => $date,
            'budgetamount' => $request->input('budgetamount'),
        ]);

        return redirect()->route('budget.create')->with('success', 'Budget updated successfully.');
    }


    public function destroy($id)
{

    $budget = Budget::findOrFail($id);

    $this->authorize('delete', $budget);

    $budget->delete();

    return redirect()->route('budget.create')->with('success', 'Budget deleted successfully.');
}

}

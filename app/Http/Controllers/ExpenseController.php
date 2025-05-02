<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BudgetExceededMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;



class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $query = Expense::with('category')->where('user_id', Auth::id());

        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
    
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
    
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }
    
        $expenses = $query->latest()->get();
        $categories = Category::all();
    
        return view('expenses.index', compact('expenses', 'categories'));
    
            
    }
        
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $categories = Category::all();
    //     return view('expenses.create', compact('categories'));
    //     //
    // }

    public function create()
    {
        $user_id = Auth::id();
    
        $allowedMonths = \App\Models\Budget::where('user_id', $user_id)
            ->pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y-m');
            })
            ->unique()
            ->values();
    
        $categories = Category::all();
    
        return view('expenses.create', compact('categories', 'allowedMonths'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $user_id = Auth::id();

    if (!$user_id) {
        return redirect()->route('profile')->with('error', 'You must be logged in.');
    }

    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date',
        'description' => 'nullable|string'
    ]);

    $user = Auth::user();
    $expenseDate = \Carbon\Carbon::parse($request->date);
    $month = $expenseDate->month;
    $year = $expenseDate->year;

    // Calculate monthly total expenses for the same month and year
    $monthlyExpenses = Expense::where('user_id', $user->id)
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->sum('amount');

    $newExpenseAmount = $request->amount;
    $totalWithNew = $monthlyExpenses + $newExpenseAmount;

    // Get budget for that user for that month/year
    $budget = \App\Models\Budget::where('user_id', $user->id)
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->first();

    if ($budget && $totalWithNew > $budget->budgetamount) {
        Mail::to($user->email)->send(new BudgetExceededMail($user, $totalWithNew));
        return redirect()->route('expenses.index')->with('success', 'Budget exceeded. Email sent. Expense not added.');
    }

    // Save the expense
    Expense::create([
        'user_id' => $user_id,
        'category_id' => $request->category_id,
        'amount' => $request->amount,
        'date' => $request->date,
        'description' => $request->description
    ]);

    return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
}

    //Report 
    public function report()
{
    $monthly = Expense::selectRaw('MONTH(date) as month, SUM(amount) as total')
        ->groupBy('month')->get();

    $labels = $monthly->pluck('month');
    $data = $monthly->pluck('total');

    return view('expenses.report', compact('labels', 'data'));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $expense = Expense::findOrFail($id);

    //     $this->authorize('update', $expense);
    //     $categories = Category::all();
    //     return view('expenses.edit', compact('expense', 'categories'));
    // }


    public function edit($id)
{
    $expense = Expense::findOrFail($id);
    $this->authorize('update', $expense);
    $categories = Category::all();

    $allowedMonths = \App\Models\Budget::where('user_id', Auth::id())
        ->pluck('date')
        ->map(function ($date) {
            return Carbon::parse($date)->format('Y-m');
        })
        ->unique()
        ->values();

    return view('expenses.edit', compact('expense', 'categories', 'allowedMonths'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $expense = Expense::findOrFail($id);
    $this->authorize('update', $expense);

    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date',
        'description' => 'nullable|string'
    ]);

    $user = Auth::user();
    $date = \Carbon\Carbon::parse($request->date);
    $month = $date->month;
    $year = $date->year;

    // Check if the new date falls within a budgeted month
    $budgetExists = \App\Models\Budget::where('user_id', $user->id)
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->exists();

    if (!$budgetExists) {
        return redirect()->back()->with('error', 'You can only update an expense to a month where a budget is set.');
    }

    // Proceed with update
    $expense->update($request->only(['category_id', 'amount', 'date', 'description']));

    return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $expense = Expense::findOrFail($id);

        $this->authorize('delete', $expense);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
    }
}
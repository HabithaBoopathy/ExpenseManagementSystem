<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function monthlyReport(Request $request)
    {
        $user = Auth::user();

        // Get the selected month and year from the request (default to current month and year)
        $month = $request->input('month', now()->month); 
        $year = $request->input('year', now()->year);

        // Get all categories for the user (even those with no expenses in the selected month/year)
        $categories = DB::table('categories')->pluck('name', 'id');

        // Get total expenses for each category in the selected month/year
        $categoryData = DB::table('expenses')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('SUM(expenses.amount) as total'))
            ->where('expenses.user_id', $user->id)
            ->whereMonth('expenses.date', $month)
            ->whereYear('expenses.date', $year)
            ->groupBy('categories.name')
            ->pluck('total', 'category');

        // Ensure every category is represented, including categories with no expenses
        $categoryTotals = $categories->mapWithKeys(function ($categoryName, $categoryId) use ($categoryData) {
            return [
                $categoryName => $categoryData->get($categoryName, 0), // Use 0 if no expenses for that category
            ];
        });

        // Calculate the grand total
        $grandTotal = $categoryTotals->sum();

        // Pass the data to the view for display
        return view('reports.monthly', [
            'categoryData' => $categoryTotals,
            'grandTotal' => $grandTotal,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Generate and download the PDF report for the selected month and year, including the grand total.
     */
    public function downloadPdfReport(Request $request)
    {
        $user = Auth::user();

        // Get the selected month and year from the request (default to current month and year)
        $month = $request->input('month', now()->month); 
        $year = $request->input('year', now()->year);

        // Get all categories for the user (even those with no expenses in the selected month/year)
        $categories = DB::table('categories')->pluck('name', 'id');

        // Get total expenses for each category in the selected month/year
        $categoryData = DB::table('expenses')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('SUM(expenses.amount) as total'))
            ->where('expenses.user_id', $user->id)
            ->whereMonth('expenses.date', $month)
            ->whereYear('expenses.date', $year)
            ->groupBy('categories.name')
            ->pluck('total', 'category');

        // Ensure every category is represented, including categories with no expenses
        $categoryTotals = $categories->mapWithKeys(function ($categoryName, $categoryId) use ($categoryData) {
            return [
                $categoryName => $categoryData->get($categoryName, 0), // Use 0 if no expenses for that category
            ];
        });

        // Calculate the grand total
        $grandTotal = $categoryTotals->sum();

        // Generate the PDF using the monthly data
        $pdf = Pdf::loadView('reports.reportpdf', [
            'categoryData' => $categoryTotals,
            'grandTotal' => $grandTotal,
            'month' => $month,
            'year' => $year,
        ]);

        // Download the PDF
        return $pdf->download('monthly_expense_report_' . $month . '_' . $year . '.pdf');
    }}
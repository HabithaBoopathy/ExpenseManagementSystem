<?php
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BudgetController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');


// Expenses
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');


Route::get('/monthlyreport', [ReportController::class, 'monthlyReport'])->name('reports.monthly');
Route::get('/download-monthlyreport', [ReportController::class, 'downloadPdfReport'])->name('reports.downloadPdf');


Route::get('/budget/create', [BudgetController::class, 'create'])->name('budget.create')->middleware('auth');
Route::post('/budget/store', [BudgetController::class, 'store'])->name('budget.store')->middleware('auth');
//Route::get('/budget/{id}/edit', [BudgetController::class, 'edit'])->name('budget.edit')->middleware('auth');
Route::get('/budget/{id}/edit', [BudgetController::class, 'edit'])->name('budget.edit');
Route::put('/budget/{id}', [BudgetController::class, 'update'])->name('budget.update');
Route::delete('/budget/{id}', [BudgetController::class, 'destroy'])->name('budget.destroy');

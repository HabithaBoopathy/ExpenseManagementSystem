<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class CheckMonthlyBudgets extends Command
{
    protected $signature = 'budget:check';
    protected $description = 'Send email reminders to users who exceeded their budget';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   
     /* The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $monthlyExpenses = Expense::where('user_id', $user->id)
                ->whereMonth('created_at', now()->month)
                ->sum('amount');
    
            if ($user->monthly_budget && $monthlyExpenses > $user->monthly_budget) {
                Mail::to($user->email)->send(new BudgetExceededMail($user, $monthlyExpenses));
            }
        }
    
        $this->info('Budget check completed.');        }
}

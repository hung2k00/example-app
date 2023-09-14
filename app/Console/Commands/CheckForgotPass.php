<?php

namespace App\Console\Commands;

use App\Models\LoyalCustomer;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckForgotPass extends Command
{
    protected $signature = 'delete:account_forgot_pass';
    protected $description = 'Delete user accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $allAccounts = LoyalCustomer::all();

        foreach ($allAccounts as $user) {
            if ($user->password_change_required == 1 && Carbon::now()->diffInMinutes($user->time_forgot) >= 2) {
                $user->delete();
            }
        }
        $this->info('Expired accounts have been deleted.');
    }
}

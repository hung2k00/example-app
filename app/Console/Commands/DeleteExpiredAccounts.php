<?php

namespace App\Console\Commands;

use App\Models\LoyalCustomer;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteExpiredAccounts extends Command
{
    protected $signature = 'delete:expired-accounts';
    protected $description = 'Delete user accounts registration time older than 2 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $allAccounts = LoyalCustomer::all();

        foreach ($allAccounts as $user) {
            if ($user->password_change_required == 1 && Carbon::now()->diffInHours($user->created_at) >= 2) {
                $user->delete();
            }
        }

        $this->info('Expired accounts have been deleted.');
    }
}

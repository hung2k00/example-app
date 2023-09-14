<?php

namespace App\Jobs;

use App\Models\LoyalCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class CheckAndDeleteExpiredAccounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $allAccounts = LoyalCustomer::all();

        foreach ($allAccounts as $user) {
            if ($user->password_change_required == 0 && Carbon::now()->diffInMinutes($user->updated_at) >= 2) {
                $user->delete();
            }
        }
    }
}

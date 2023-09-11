<?php

namespace App\Jobs;

use App\Mail\JustTesting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmail implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $randomPassword;
    protected $name;

    public function __construct($email, $randomPassword, $name)
    {
        $this->email = $email;
        $this->randomPassword = $randomPassword;
        $this->name = $name;
    }

    public function handle()
    {
        Mail::send(new JustTesting($this->email, $this->randomPassword, $this->name));
    }
}

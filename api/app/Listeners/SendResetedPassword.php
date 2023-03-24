<?php

namespace App\Listeners;
use App\Events\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendResetedPassword
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ResetedPassword $event): void
    {
        Mail::to($user->email)->send(new ResetedPasswordMail($user->name));
    }
}

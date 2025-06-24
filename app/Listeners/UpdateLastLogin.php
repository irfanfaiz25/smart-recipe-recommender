<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class UpdateLastLogin
{
    public function handle(Login $event)
    {
        $event->user->update([
            'last_login_at' => now()
        ]);
    }
}

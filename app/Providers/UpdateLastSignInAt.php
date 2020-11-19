<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class UpdateLastSignInAt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

      $user = $event->user;
      DB::table('users')
        ->where('id', $user->id)
        ->update([
          'last_sign_in_at'    => ($user->current_sign_in_at ? $user->current_sign_in_at : Carbon::now()),
          'current_sign_in_at'    => Carbon::now(),
        ]);
    }
}

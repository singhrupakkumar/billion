<?php

namespace App\Listeners;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\LoginLogs;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
		
		LoginLogs::create(['user_id'=>$event->user->id,'ip_address'=>$this->request->ip()]);
		// $user->last_login_ip = $this->request->ip();
        // $event->user->last_login = \Carbon::now();
        // $event->user->save();
    }
}

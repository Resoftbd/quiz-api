<?php

namespace App\Http\Middleware;

use App\Models\BaseModel;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role != BaseModel::ROLE_ADMIN && Auth::user()->subscription == User::SUBSCRIPTION_YES && Auth::user()->subscription_status  == User::SUBSCRIPTION_INACTIVE){

            return redirect('/billing/history');
        }
        return $next($request);
    }
}

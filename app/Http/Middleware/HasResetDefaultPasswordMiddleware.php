<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class HasResetDefaultPasswordMiddleware
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
        $user = User::whereId(auth()->user()->id)->first();
        
        if ($user->default_password_reset_at === NULL) {
            return redirect()->route('password-update-form');
        }
        
        return $next($request);
    }
}

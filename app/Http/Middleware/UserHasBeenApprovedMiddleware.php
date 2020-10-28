<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class UserHasBeenApprovedMiddleware
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

        if ($user->approved === User::UNAPPROVED) {
            return abort(403, 'Looks Like Your Account has not been approved!');
        }

        return $next($request);
    }
}

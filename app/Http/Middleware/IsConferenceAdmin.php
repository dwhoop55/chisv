<?php

namespace App\Http\Middleware;

use Closure;

class IsConferenceAdmin
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
        if (auth()->user() && ( auth()->user()->isAdmin() /*|| hasPermissionForEditingThisConference */) ) {
            return $next($request);
        } else {
            return abort(403, 'You cannot manage conferences');
        }
    }
}

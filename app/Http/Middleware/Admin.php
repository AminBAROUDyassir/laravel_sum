<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
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
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            $role = Auth::user()->type;

            switch ($role) {

                case 'A':
                    return $next($request);
                    break;

                default:
                    return redirect()->route('login');
                    break;
            }
        }

        /*
        if (Auth::guard($guard)->check()) {
        return redirect(RouteServiceProvider::HOME);
        }
         */

        // return $next($request);
    }
}

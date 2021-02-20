<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminSignOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $idToken = $request->session()->get('idToken');

        if($idToken) {
            return redirect()->route('admin_dashboard');
        }
 
        return $next($request);
    }
}

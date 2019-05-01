<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if ($request->user() && $request->user()->access_role != 'ADMIN') {
            return abort(403, 'Unauthorized action.');
            //return new Response(view('inc.unauthorized')->with('role', 'ADMIN'));
        }
            return $next($request);
    }
}

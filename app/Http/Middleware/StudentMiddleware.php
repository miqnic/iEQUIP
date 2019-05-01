<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if ($request->user() && $request->user()->access_role != 'STUDENT') {
            return abort(403, 'Unauthorized action.');
            //return new Response(view('inc.unauthorized')->with('role', 'STUDENT'));
        }
            return $next($request);
    }
}

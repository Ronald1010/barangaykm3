<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    // public function handle($request, Closure $next)
    // {
    //     if(auth()->user() && auth()->user()->is_admin) {
    //         return $next($request);
    //     }
        
    //     // Check if the request is an API request
    //     if ($request->expectsJson()) {
    //         return response()->json(['error' => 'You do not have permission to access this resource.'], 403);
    //     }
        
    //     // For non-API requests, you can still redirect if needed
    //     return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    // }
}

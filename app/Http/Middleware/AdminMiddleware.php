<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user is authenticated
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // If not admin, return unauthorized response
        return response()->json(['message' => 'Unauthorized. Only admin users are allowed.'], 403);
    }
}

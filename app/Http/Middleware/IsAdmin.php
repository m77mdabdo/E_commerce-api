<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == "admin") {
            return $next($request);
        } else {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized. Admins only.'
                ], 403); // Forbidden
            }


            return redirect(route('home')); // Redirect to home or any other page
        }
    }
}

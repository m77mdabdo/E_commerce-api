<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->header('access_token');

        if (!$access_token) {
            return response()->json([
                "msg" => "Access token not found."
            ], 401);
        }

        $user = User::where("access_token", $access_token)->first();

        if (!$user) {
            return response()->json([
                "msg" => "Invalid access token."
            ], 401);
        }

        // يمكنك تمرير المستخدم لو أردت:
        // $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}

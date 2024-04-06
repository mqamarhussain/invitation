<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is an admin
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user has a business profile
        if (!auth()->user()->is_admin && !auth()->user()->business_profile()->exists()) {
            // User does not have a business profile
            return redirect()->route('business_profile'); // Redirect to create business profile page
            // or return response()->json(['error' => 'No business profile found'], 403); // Return forbidden response
        }

        // User has a business profile, continue with the request
        return $next($request);
    }
}

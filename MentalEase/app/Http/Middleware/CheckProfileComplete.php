<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = session('user');
        
        // If user is logged in but hasn't completed their profile
        if ($user && !$user->has_completed_profile) {
            // Allow access to logout and profile completion routes
            if ($request->routeIs('logout') || $request->routeIs('profile.complete')) {
                return $next($request);
            }
            
            // Redirect to profile completion page
            return redirect()->route('profile.complete');
        }
        
        return $next($request);
    }
}
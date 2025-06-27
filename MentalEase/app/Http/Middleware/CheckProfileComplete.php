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
                $response = $next($request);
                
                // Add cache control headers to prevent caching
                return $this->addNoCacheHeaders($response);
            }
            
            // For AJAX requests, return a JSON response
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'redirect' => route('profile.complete'),
                    'message' => 'Please complete your profile first.'
                ], 403);
            }
            
            // Redirect to profile completion page with cache control headers
            return redirect()->route('profile.complete')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->header('Cache-Control', 'post-check=0, pre-check=0', false)
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        }
        
        // User has completed profile or is not logged in
        $response = $next($request);
        
        // Add cache control headers to all responses
        return $this->addNoCacheHeaders($response);
    }

    /**
     * Add no-cache headers to response
     */
    private function addNoCacheHeaders($response)
    {
        if (method_exists($response, 'header')) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->header('Cache-Control', 'post-check=0, pre-check=0', false)
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        }
        
        return $response;
    }
}


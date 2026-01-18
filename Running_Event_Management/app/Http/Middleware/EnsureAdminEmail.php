<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureAdminEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check for specific admin email
        $user = Auth::user();
        if ($user->Email !== '2472034@maranatha.ac.id') {
            // Option 1: Abort 403
            // abort(403, 'Unauthorized access.');
            
            // Option 2: Redirect to user dashboard with warning
            return redirect()->route('dashboard')->with('error', 'Unauthorized access to Admin area.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                // Redirect berdasarkan role
                if ($user->isOwner()) {
                    return redirect()->route('owner.dashboard');
                }
                
                if ($user->isCashier()) {
                    return redirect()->route('cashier.dashboard');
                }
                
                return redirect('/');
            }
        }

        return $next($request);
    }
}
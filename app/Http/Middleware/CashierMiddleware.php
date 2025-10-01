<?php
// app/Http/Middleware/CashierMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashierMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (!auth()->user()->isCashier() && !auth()->user()->isOwner())) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
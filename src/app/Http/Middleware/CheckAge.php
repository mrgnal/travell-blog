<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        print($request->age);
        if ($request->age && $request->age < 18) {
            return redirect('/');
        }

        return $next($request);
    }
}

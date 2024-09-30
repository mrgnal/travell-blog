<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckName
{
     public function handle(Request $request, Closure $next)
    {
        print($request->name);
        if (!$request->name) {
            return redirect('/');
        }
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FreelanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && in_array(auth()->user()->user_type, ['freelancer', 'sub_freelancer'])) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}


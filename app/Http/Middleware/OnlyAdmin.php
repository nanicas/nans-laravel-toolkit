<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class OnlyAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Helper::isAdmin()) {
            return $next($request);
        }

        return Helper::notAllowedResponse($request);
    }
}
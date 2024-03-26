<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckJwtMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Authorization')) {
            // Nếu có token, chuyển tiếp request đến middleware xác thực token
            return $next($request);
        }

        // Nếu không có token, cho phép truy cập vào API
        return $next($request);
    }
}

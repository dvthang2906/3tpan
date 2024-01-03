<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::user());

        // Kiểm tra xem người dùng có đăng nhập và có phải là admin không
        if (Auth::check() && Auth::user()->isAdministrator()) {

            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng người dùng
        return redirect('login');
    }
}

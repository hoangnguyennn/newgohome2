<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            return redirect()->route('posts.index')->with('danger', 'Bạn không có quyền truy cập vào mục này');
        }

        return $next($request);
    }
}

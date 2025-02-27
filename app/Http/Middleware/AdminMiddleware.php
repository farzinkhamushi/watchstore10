<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Spatie\Permission\Contracts\Role;
//use Spatie\Permission\Models\HasRoles;
use Spatie\Permission\Traits\HasRoles;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user->is_admin || $user->hasRole(['مدیر کل'])) {
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\ProfileModels;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::check()
            && Auth::user()->id_role == 3
            && Auth::user()->is_active == 'Y'
        ) {
            if (is_null(ProfileModels::whereid_users(Auth::user()->id)->first())) {
                return redirect()->route('profile');
            }
            return $next($request);
        }
        return redirect('/');
    }
}

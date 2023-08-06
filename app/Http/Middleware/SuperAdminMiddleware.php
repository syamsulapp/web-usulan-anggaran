<?php

namespace App\Http\Middleware;

use App\Models\ProfileModels;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (
            Auth::check()
            && Auth::user()->id_role == 1
            && Auth::user()->is_active == 'Y'
        ) {
            if ($cekPhoto = ProfileModels::whereid_users(Auth::user()->id)->first()) {
                if (empty($cekPhoto->photos)) { //kalo fotonya gak upload maka redirect to profile untuk upload foto(melengkapi data profile)
                    return redirect()->route('profile')->with('alertError', 'lengkapi profile superadmin untuk kebutuhan verifikasi usulan dari users');
                }
            }
            return $next($request);
        }

        return redirect('/');
    }
}

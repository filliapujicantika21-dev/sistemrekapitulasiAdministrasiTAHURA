<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleUser
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (Auth::check()) {

            $userRole = Auth::user()->role;


            if (in_array($userRole, $roles)) {

                return $next($request);

            }

        }


        return redirect('/dashboard')
            ->with('error', 'Anda tidak memiliki akses ke halaman ini');

    }
}
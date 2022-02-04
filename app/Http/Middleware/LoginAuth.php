<?php

namespace App\Http\Middleware;

use Closure, Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\SsoController;

class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        if (!empty(Session::get('email'))) {
            return $next($request);
        }

        $sso = new SsoController();
        if (!empty($request->get('code'))) {
            $sso->redirects($request);
        }
        $all = Session::get('authLogin');

        if (!empty($all->access_token)) {

            $check = $sso->checkAccessToken($all);
            if (!empty($check)) {
                return redirect()->route('sso-action');
            } else {
                $getNewToken = $sso->getNewAccessToken($all);
                if (!empty($getNewToken)) {
                    return redirect()->route('sso-action');
                }
            }
        }
        return redirect($sso->signInUrl());
    }
}

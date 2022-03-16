<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;

use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // custom logout function
    // redirect to login page
    /* public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/login');
    } */


    // redirect to login page
    public function logout(Request $request)
    {
        $all = Session::get('authLogin');
        //dd($all);
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        if ($response = $this->loggedOut($request)) {
            Session::put('authLogin', $all);
            return $response;
        }

        Session::put('authLogin', $all);
        // Auth::logout();
        // $request->Session::flush();
        return redirect('message')->with('logout', __('You have successfully logged out.'));
        // return redirect('logout');
        // ->with('logout', __('You have successfully logged out.'));

        // return $request->wantsJson()
        //     ? new Response('', 204)
        //     : redirect('/message');
    }

}

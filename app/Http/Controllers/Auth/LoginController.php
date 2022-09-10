<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Auth;

use Zevitagem\LaravelSaasTemplateCore\Providers\RouteServiceProvider;
use Zevitagem\LegoAuth\Controllers\Laravel\LoginLaravelNotSourceController;

class LoginController extends LoginLaravelNotSourceController
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

    //use AuthenticatesUsers;

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
        //$this->middleware('guest')->except('logout');

        parent::__construct();
    }

//    public function redirectPath()
//    {
//        return Session::get('slug') . $this->redirectTo;
//    }
//
//    protected function authenticated(Request $request, $user)
//    {
//        Session::put('slug', $user->getOwn());
//    }
}

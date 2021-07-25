<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;

    public function redirectTo()
    {

        $role = Auth::user()->type;

        info("----------- info user start ---------");
        info($role);
        info("----------- info user end ---------");
        switch ($role) {
            case "A":
                $this->redirectTo = '/admin/home';
                return $this->redirectTo;
                break;
            case "V":
                $this->redirectTo = '/vendor/home';
                return $this->redirectTo;
                break;

            default:
                return '/';
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
/*
protected function credentials(Request $request)
{
return array_merge($request->only($this->username(), 'password') , ['is_root' => 'Y'] );
}
 */
}

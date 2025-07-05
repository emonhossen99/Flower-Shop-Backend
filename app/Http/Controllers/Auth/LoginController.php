<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->role->slug == 'super' || Auth::check() && Auth::user()->role->slug == 'admin') {
            return route('admin.dashboard.index');
        } else if (Auth::check() && Auth::user()->role->slug == 'staff') {
            return route('staff.dashboard.index');
        } else if (Auth::check() && Auth::user()->role->slug == 'project_manager') {
            return route('projectmanager.dashboard.index');
        } else if (Auth::check() && Auth::user()->role->slug == 'product_manager') {
            return route('productmanager.dashboard.index');
        } else if (Auth::check() && Auth::user()->role->slug == 'selles_manager') {
            return route('sellesmanager.dashboard.index');
        }else if (Auth::check() && Auth::user()->role->slug == 'purchase_manager') {
            return route('purchasemanager.dashboard.index');
        }else if (Auth::check() && Auth::user()->role->slug == 'client_portal') {
            // return route('clientportal.dashboard.index');
            return '/';
        }else{
            return '/';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}

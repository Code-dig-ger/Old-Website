<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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
    public function username()
    {
        return 'username';
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function middle_login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $username    = $request['username'];

        $user = User::whereUsername($username)->first();

        if($user && ($user->admin || $user->is_password))
        {
            return view('auth/admin' , ['username' => $username]);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }

    public function middle_login_get()
    {
        return view('auth/admin' , ['username' => NULL]);
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\{Codeforces,uva,Spoj,Codechef};
use Illuminate\Http\Request;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string' , 'max:255', 'unique:users'],
            'uva' => ['nullable' , new uva],
            'spoj' => ['nullable' , new Spoj],
            'codechef' => ['nullable' , new Codechef],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $id = null;
        if($data['uva'])
        {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://uhunt.onlinejudge.org/api/uname2uid/'. $data['uva']);
            $id = strval($response->getBody());
        }
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'codeforces' => $data['codeforces'],
            'codechef' => $data['codechef'],
            'spoj' => $data['spoj'],
            'uva' => $data['uva'],
            'uvaid' => $id
        ]);
    }

    // Next Step for Register

    public function show_register_next(Request $request)
    {
        return view('auth.register_next');
    }

    public function register_next(Request $request)
    {
        //return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string' , 'max:255', 'unique:users'],
            'codeforces' => ['required' ,'string' , new Codeforces],
        ]);
        $user = [
            'name' => $request['name'] , 
            'username' => $request['username'] , 
            'codeforces' => $request['codeforces']
        ];

        return view('auth.register_next' , ['user' => $user] );
    }


}

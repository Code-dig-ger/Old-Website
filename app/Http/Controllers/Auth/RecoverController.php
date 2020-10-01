<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RecoverController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function recover()
    {
        return view('auth/recover' , ['account' => false , 'user' => NULL ]);
    }

    public function recover_account(Request $request)
    {
        $user = User::wherecodeforces($request["codeforces"])->first();

        return view('auth/recover' , ['account' => true , 'user' => $user ]);
    }
}

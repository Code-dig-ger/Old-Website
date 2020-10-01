<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = auth()->user();
        $cur = \Carbon\Carbon::now();
        $user['last_visit'] = $cur;
        $user->update();
        return view('home');
    }
    public function index()
    {
       if (Auth::check()) 
         return redirect()->route('dashboard');
        else
            return view('index');
    }
    public function developer()
    {
        return view('dev');
    }
    public function feedback()
    {
        return view('feedback');
    }
    public function feedback_response()
    {
        return view('feedback_response');
    }
}


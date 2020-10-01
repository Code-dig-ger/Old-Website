<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\{Codeforces,uva,Codechef,Spoj};
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('admin' , 'desc')->orderBy('is_password' , 'desc')->paginate(20);
        $count = count(User::all());
        $today = User::where('last_visit', '>=', \Carbon\Carbon::today())->count();
        $yesterday = User::where('last_visit' , '>=' , \Carbon\Carbon::yesterday())->count();
        $week = User::where('last_visit' , '>=' , \Carbon\Carbon::now()->startOfWeek())->count();
        $month = User::where('last_visit' , '>=' , \Carbon\Carbon::now()->startOfMonth())->count();

        if($request["search"])
        {
            $users = User::where('name' , 'like' , '%' . $request["search"] .  '%')
                ->orWhere('codeforces', 'like', '%' . $request["search"] . '%')
                ->orWhere('codechef', 'like', '%' . $request["search"] . '%')
                ->orWhere('uva', 'like', '%' . $request["search"] . '%')
                ->orWhere('spoj', 'like', '%' . $request["search"] . '%')
                ->orWhere('username', 'like', '%' . $request["search"] . '%')
                ->paginate(10);
            return view('user.index' ,["users" => $users , 
                'count' => $count ,
                'today' => $today ,
                'yesterday' => $yesterday ,
                'week' => $week ,
                'month' => $month ]);
        } 

        return view('user.index' ,["users" => $users , 
                'count' => $count ,
                'today' => $today ,
                'yesterday' => $yesterday ,
                'week' => $week ,
                'month' => $month ]);
    }

    public function update_role(Request $Request , $id)
    {
        $user = User::whereId($id)->firstorFail();
        if($user->admin)
            $user['admin'] = false;
        else
            $user['admin'] = true;
        $user->update();
        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request['disable_password'])
        {
            $user = auth()->user();
            $user['is_password'] = 0;
            $user['admin'] = 0;
            $user['password'] = bcrypt("0");
            $user->update();
            
            session()->flash('success','Your details are updated successfully! Keep Coding');
            return redirect()->route('dashboard');
        }
        return view('user/edit' , ['enable_password' => $request["enable_password"]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request["codeforces"] && $request["codeforces"] != auth()->user()->codeforces)
        {
            //Validate codeforces
            $request->validate([
                'codeforces' => ['required','string',new Codeforces],
            ]);
        }

        $id = NULL;

        if($request["uva"] && $request["uva"] != auth()->user()->uva)
        {
            //Validate uva
            $request->validate([
                'uva' => ['string',new uva],
            ]);

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://uhunt.onlinejudge.org/api/uname2uid/'. $request['uva']);
            $id = strval($response->getBody());
        }

        if($request["codechef"] && $request["codechef"] != auth()->user()->codechef)
        {
            //Validate codechef
            $request->validate([
                'codechef' => ['string' , new Codechef],
            ]);
        }

        if($request["spoj"] && $request["spoj"] != auth()->user()->spoj)
        {
            //Validate spoj
            $request->validate([
                'spoj' => ['string' , new Spoj],
            ]);
        }

        $user = auth()->user();
        $user['name'] = $request["name"];
        $user['codeforces'] = $request["codeforces"];
        $user['codechef'] = $request["codechef"];
        $user['uva'] = $request["uva"];
        $user['spoj'] = $request["spoj"];
        if($id)
            $user['uvaid'] = $id;

        if($request["password"] != null)
        {
            $user['is_password'] = 1;
            $user['password'] = bcrypt($request["password"]);
        }

        $user->problem()->detach();

        $user->update();

        session()->flash('success','Your details are updated successfully! Keep Coding');

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

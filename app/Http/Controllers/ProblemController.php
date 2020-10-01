<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Password;
use App\Models\{Generaltopic,Topic,Problem};

class ProblemController extends Controller
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
        if($request["search"])
        {
            $problems = Problem::where('code' , 'like' , '%' . $request["search"] .  '%')
                ->orWhere('name', 'like', '%' . $request["search"] . '%')
                ->paginate(10);
            $count = Problem::whereStatus('accepted')->count();
            return view('Problem.index' , ['problems' => $problems , 'count' => $count]);
        }
        $problems = Problem::whereStatus('accepted')->paginate(20);
        $count = Problem::whereStatus('accepted')->count();
        return view('Problem.index' , ['problems' => $problems , 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::All();
        $Generaltopics = Generaltopic::All();
        return view('Problem/create'  , [
            'topics' => $topics ,
            'Generaltopics' => $Generaltopics,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'required|unique:problems',
        ]);

        $data = [
            'name' => $request->name,
            'platform' => $request->platform,
            'code' => $request->code , 
            'topic_id' => $request->topic,
            'generaltopic_id' => $request->Generaltopic,
            'dif' => $request->dif, 
            'link' => $request->link , 
            'desc' => $request->desc ,
            'status' => 'accepted'
        ];

        $problem = Problem::create($data);

        session()->flash('success','Problem Created Successfully!');

        return redirect()->route('problem.create');
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
    public function edit($id)
    {
        $problem = Problem::whereid($id)->firstOrFail();

        $topics = Topic::All();

        $Generaltopics = Generaltopic::All();

        return view('Problem.edit' , ["topics" => $topics , "problem" => $problem , "Generaltopics" => $Generaltopics ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $problem = Problem::whereid($id)->firstOrFail();

        $data = [
            'name' => $request->name,
            'platform' => $request->platform,
            'code' => $request->code , 
            'topic_id' => $request->topic,
            'generaltopic_id' => $request->Generaltopic,
            'dif' => $request->dif, 
            'link' => $request->link , 
            'desc' => $request->desc ,
            'status' => 'accepted'
        ];

        $problem->update($data);

        session()->flash('success','Problem Updated!');

        return redirect()->route('problem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $problem = Problem::whereid($id)->firstOrFail();
    
        $problem->delete();

        session()->flash('success','Problem Deleted!');

        return redirect()->route('problem.index');
    }
}

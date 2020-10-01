<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Password;
use App\Models\{Topic,Problem};

class TopicController extends Controller
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
    public function index()
    {
        $topics = Topic::paginate(20);
        return view('Topic.index' , ['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Topic/create');
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
            'name' => 'required|unique:topics',
        ]);

        $data = [
            'name' => $request->name,
            'dif' => $request->dif,
            'desc' => $request->desc,
            'youtube_video' => $request->youtube_video,
            'contest_link' => $request->contest_link,
            'editorial_link' => $request->editorial_link
        ];
        Topic::create($data);
        session()->flash('success','Topic Created Succesfully!');
        return redirect()->route('topic.create');
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
        $topic = Topic::whereid($id)->firstOrFail();

        return view('Topic.edit' , ["topic" => $topic ]);
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
        $topic = Topic::whereid($id)->firstOrFail();

        $data = [
            'name' => $request->name,
            'dif' => $request->dif,
            'desc' => $request->desc,
            'youtube_video' => $request->youtube_video,
            'contest_link' => $request->contest_link,
            'editorial_link' => $request->editorial_link
        ];

        $topic->update($data);

        session()->flash('success','Topic Updated!');

        return redirect()->route('topic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::whereid($id)->firstOrFail();
    
        $topic->delete();

        session()->flash('success','Topic Deleted!');

        return redirect()->route('topic.index');
    }
}

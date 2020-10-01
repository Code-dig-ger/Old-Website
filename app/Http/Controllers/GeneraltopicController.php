<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Password;
use App\Models\{Generaltopic,Problem};

class GeneraltopicController extends Controller
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
        $Generaltopics = Generaltopic::paginate(20);
        return view('Generaltopic.index' , ['Generaltopics' => $Generaltopics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Generaltopic/create');
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
            'name' => 'required|unique:generaltopics',
        ]);

        $data = [
            'name' => $request->name,
            'dif' => $request->dif,
            'desc' => $request->desc
        ];
        Generaltopic::create($data);
        session()->flash('success','Generaltopic Created Succesfully!');
        return redirect()->route('Generaltopic.create');
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
        $Generaltopic = Generaltopic::whereid($id)->firstOrFail();

        return view('Generaltopic.edit' , ["Generaltopic" => $Generaltopic ]);
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
        $Generaltopic = Generaltopic::whereid($id)->firstOrFail();

        $data = [
            'name' => $request->name,
            'dif' => $request->dif,
            'desc' => $request->desc
        ];

        $Generaltopic->update($data);

        session()->flash('success','Generaltopic Updated!');

        return redirect()->route('Generaltopic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Generaltopic = Generaltopic::whereid($id)->firstOrFail();
    
        $Generaltopic->delete();

        session()->flash('success','Generaltopic Deleted!');

        return redirect()->route('Generaltopic.index');
    }
}

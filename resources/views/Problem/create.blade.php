@extends('layouts.app') 
@section('title')
<title>Codedigger Create New Problems</title>
@endsection
@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
<section class="cover">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >Create New Problem</h1>
                </div>
                <hr>
                <form autocomplete="off" method="POST" action="{{ route('problem.store') }}" class="row mt-0" enctype="multipart/form-data">
                    @csrf

                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                    
                    <div class="col-md-12">
                        <label>Problem Title</label>
                        <input type="text" name="name" placeholder="Name" class="validate-required" value="{{ old('name') ? old('name') : '' }}"
                            required />
                    </div>

                    <div class="col-md-12">
                        <label>Platform</label>
                        <select name="platform" class="text-dark">
                            <option value="codeforces">Codeforces</option>
                            <option value="codechef">Codechef</option>
                            <option value="spoj">Spoj</option>
                            <option value="uva">UVa</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label>Topic</label>
                        <select name="topic" class="text-dark">
                            @foreach ($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic -> name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label>General Difficulty</label>
                        <select name="Generaltopic" class="text-dark">
                            @foreach ($Generaltopics as $topic)
                            <option value="{{$topic->id}}">{{$topic -> name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label>Problem Code</label>
                        <span>E.g. Codeforces - 4A , Codechef - FLOW001 , UVa Problem ID - 2113 , Spoj - SMPSUM </span>
                        <input type="text" name="code" placeholder="Code" class="validate-required @error('code') is-invalid @enderror" value="{{ old('code') ? old('code') : '' }}"
                            required />
                        @error('code')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label>Difficulty</label>
                        <input type="number" name="dif" placeholder="Difficulty" class="validate-required" value="{{ old('dif') ? old('dif') : '' }}"
                            required />
                    </div>

                    <div class="col-md-12">
                        <label>Problem Link</label>
                        <input type="text" name="link" placeholder="Link" class="validate-required" value="{{ old('link') ? old('link') : '' }}"
                            required />
                    </div>

                    <div class="col-md-12">
                        <label>Description(optional)</label>
                        <input type="text" name="desc" placeholder="Description" value="{{ old('desc') ? old('desc') : '' }}"
                             />
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn--sm type--upercase">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
</section>
@endsection
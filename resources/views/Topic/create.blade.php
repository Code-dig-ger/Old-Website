@extends('layouts.app') 
@section('title')
<title>Codedigger Create New Topic </title>
@endsection
@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >Create new Topic</h1>
                </div>
                <hr>
                <form method="POST" action="{{ route('topic.store') }}" class="row mt-0" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label>Topic Name</label>
                        <input type="text" name="name" placeholder="Name" class="validate-required @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : '' }}"
                            required />
                        @error('name')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label>Difficulty</label>
                        <input type="number" name="dif" placeholder="Difficulty" class="validate-required" value="{{ old('dif') ? old('dif') : '' }}"
                            required />
                    </div>
                    <div class="col-md-12">
                        <label>Youtube Video Link(optional)</label>
                        <input type="text" name="youtube_video" placeholder="Youtube Playlist Link (Embed one)" value="{{ old('youtube_video') ? old('youtube_video') : '' }}"
                             />
                    </div>
                    <div class="col-md-12">
                        <label>Contest Link(optional)</label>
                        <input type="text" name="contest_link" placeholder="Codeforces Contest Link" value="{{ old('contest_link') ? old('contest_link') : '' }}"
                             />
                    </div>
                    <div class="col-md-12">
                        <label>Editorial Link(optional)</label>
                        <input type="text" name="editorial_link" placeholder="Contest Editorial Link" value="{{ old('editorial_link') ? old('editorial_link') : '' }}"
                             />
                    </div>

                    <div class="col-md-12">
                        <label>Description(optional)</label>
                        <input type="text" name="desc" placeholder="Topic Description" value="{{ old('desc') ? old('desc') : '' }}"
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
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
@endsection
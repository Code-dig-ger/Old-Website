@extends('layouts.app')

@section('title')
<title>Codedigger No Problems in this Level</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
<section class="cover">
<section class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >Sorry!!</h1></div>
                <hr>    
                @if($isproblem)
                <p>
                    Problems to this Difficulty are on different platform. <br>  Please add your handles to solve them. <br>  Keep Coding!
                </p>
                @else
                <p>
                    No Problem to this Difficulty Level added till Now. <br>    New Problems will be added soon.
                    <br>    Stay Tune and Keep Coding!
                </p>
                @endif
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
</section>

@endsection

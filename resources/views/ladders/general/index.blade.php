@extends('layouts.app')

@section('title')
<title>Codedigger Level wise Ladders Index</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >LevelWise Ladder</h1>
                </div>
                <p>
                    <strong>You are solving Ladder, Next Problem is Locked until you solved current one.
                    <br> If you want to see all the problems, go to Practice Section.
                    <br>
                    Happy Coding :)
                </strong>
                </p>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
    <br>
    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($topics as $item)
                    <h4>{{$item->name}}
                    </h4>
                    <div class="row">
                        <div class="col-md-8">
                            {{ $item-> desc}}
                            <p class="mt-2">
                            @if($item->problem()->count())
                            
                                <a class="btn btn--sm" href="{{route('ladders.general.show' ,$item->id)}}">
                                    <span class="btn__text">
                                    @if(auth()->user()->generaltopic->contains($item->id))
                                        Continue
                                    @else
                                        Start
                                    @endif
                                   
                                </span>
                            </a>
                            @else
                            <a class="btn btn--sm disabled" href="{{route('practice.general.show' ,$item->id)}}">
                                    <span class="btn__text">
                                    Coming Soon!
                                </span>
                            </a>
                            @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection

@extends('layouts.app')
@section('title')
<title>Codedigger Topic wise Competitive Programming Practice</title>
@endsection

@section('content')

<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;">Topicwise Practice</h1></div>
            </div>
            @if(!auth()->user())
            <p class = "imagebg">
                    <strong>You are using Codedigger as Guest, You will not be able to see all the features of this site and solved problems. 
                    <br> Please Register on Codedigger to try all the features such as Upsolving, Ladder and Practice in a better way.
                    <br>
                    Happy Coding :)
                </strong>
            </p>
            @endif
        </div>
        <!--end of row-->
    </div>
    <br>
    <br>
    <!--end of container-->

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
                            
                                <a class="btn btn--sm" href="{{route('practice.topicwise.show' ,$item->id)}}">
                                    <span class="btn__text">
                                    Pratice this Topic
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

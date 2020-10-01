@extends('layouts.app')
@section('title')
<title>Codedigger | {{$topic->name}} Ladders Problems</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;">{{$topic->name}} Topic Problems</h1></div>
                <strong><p>
                    Solve this problem to unlock next.
                    <br>
                    Solved Problems - {{$cur_ind}}
                    <br>
                    Unsolved Problems in this Topic - {{count($solved_problems) - $cur_ind}}
                </p></strong>
            </div>
            <div class="masonry imagebg">
            <div class="card card-1 boxed boxed--sm ">
                <div class="card__top">
                    <div class="card__avatar">
                        <span>
                            <strong>Solved a Problem?</strong>
                        </span>
                    </div>
                </div>
                <div class="card__body">
                    <a class="btn btn--sm" href="{{route('ladders.topicwise.show' ,$problem->topic->id) }} ">
                        <span class="btn__text">Update</span>
                    </a>
                </div>
            </div>
        </div>

        
        <!--end of row-->
    </div>
</div>
    <!--end of container-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12 col-lg-10">
                    <div class="masonry imagebg">
                        <div class="masonry__container row">
                            <div class="col-md-6 masonry__item">
                                <div class="card card-1 boxed boxed--sm boxed--border">
                                    <div class="card__top">
                                        <div class="card__avatar">
                                            <span>
                                                <strong>{{ $problem->name }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <a target = "_blank" class="btn btn--sm" href="{{ $problem->link }}">
                                            <span class="btn__text">Solve</span>
                                        </a>
                                    </div>
                                    <div class="card__bottom">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <div class="card__action">
                                                    <span>{{ $problem->desc }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-1 masonry__item">
                                <div class="boxed boxed--sm">
                                    <div>
                                        <small>Platform </small>
                                        <h3 class="d-inline">{{ ucfirst($problem->platform) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                <h3>Solved Problems</h3>
                <hr>
                @if($cur_ind != 0)
                    <ul class="accordion accordion-2 accordion--oneopen">
                        @for ($x = 0; $x < $cur_ind; $x++)
                        <li>
                            <div class="accordion__title">
                                <span class="h5">{{$solved_problems[$x]->name}}
                                <small>
                                    <span class="badge">
                                        {{ucfirst ($solved_problems[$x]->platform)}}
                                    </span>
                                </small>
                                </span>
                            </div>
                            <div class="accordion__content">
                        <small>
                        {{ $solved_problems[$x]->desc }}
                        </small>

                        <div class="text-right d-block">
                                    <a target="_blank" class="btn btn--sm" href="{{$solved_problems[$x]->link}}">
                                        <span class="btn__text">
                                            Visit Again?
                                        </span>
                                    </a>
                        </div>

                    </div>
                </li>
                @endfor
            </ul>
            @else
            <small>You have not solved any problems yet.</small>

            @endif
        </div>
        @if($topic->contest_link != NULL)
        <br>
        <br>
        <div class="col-md-8">
                <div class="h4">Wanna Try a virtual Contest on this Topics Problems Only??</div>
                <hr>
            <a target="_blank" class="btn btn--sm" href="{{$topic->contest_link}}">
                    <span class="btn__text">
                        Go to Contest
                    </span>
            </a>
            @if($topic->editorial_link != NULL)
            <a target="_blank" class="btn btn--sm" href="{{$topic->editorial_link}}">
                    <span class="btn__text">
                        Video Editorial
                    </span>
            </a>
            @endif
            </div>
       @endif
        </div>
    </div>
</div>

@if($topic->youtube_video != NULL)
<section class="switchable switchable--switch feature-large">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="switchable__text">
                    <div class="text-block">
                        <h2>{{$topic->name}} Tutorial</h2>
                        <span>Don't know much about this Topic? Learn from this tutorial and then practice again.</span>
                    </div>
                    <p class="lead">
                        Happy Coding!!
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <iframe width="560" height="315" src="{{$topic->youtube_video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
@endif
</section>
@endsection

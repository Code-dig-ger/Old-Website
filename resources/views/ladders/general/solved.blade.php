@extends('layouts.app')

@section('title')
<title>Codedigger | Solved all Problems</title>
@endsection

@section('content')

<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >Hurray!!</h1></div>
                <p>
                    You have solved all the problems of this difficulty.
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
                <h3>Solved Problems</h3>
                <hr>
                    <ul class="accordion accordion-2 accordion--oneopen">
                        @foreach ($solved_problems as $item)
                        <li>
                            <div class="accordion__title">
                                <span class="h5">{{$item->name}}
                                <small>
                                    <span class="badge">
                                        {{ucfirst ($item->platform)}}
                                    </span>
                                </small>
                                </span>
                            </div>
                            <div class="accordion__content">
                        <small>
                        {{ $item->desc }}
                        </small>

                        <div class="text-right d-block">
                                    <a target="_blank" class="btn btn--sm" href="{{$item->link}}">
                                        <span class="btn__text">
                                            Visit Again?
                                        </span>
                                    </a>
                        </div>

                    </div>
                </li>
                @endforeach
            </ul>
        </div>
            </div>
        </div>
    </div>
</section>
@endsection

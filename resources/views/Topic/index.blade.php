@extends('layouts.app')
@section('title')
<title>Codedigger Topics</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
    <section class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8">
                    <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >All Topics</h1>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <ul class="accordion accordion-2 accordion--oneopen">
                        @foreach ($topics as $item)
                        <li>
                            <div class="accordion__title">
                                <span class="h5">{{$item->name}}
                                </span>
                            </div>
                            <div class="accordion__content">
                        <small>
                        Difficulty : {{ $item->dif }}
                        <br>
                        Description : {{ $item->desc }}
                        <br>
                        Youtube Video : {{ $item->youtube_video }}
                        <br>
                        Contest Link : {{ $item->contest_link }}
                        <br>
                        Editorial Link : {{ $item->editorial_link }}
                        <br>
                        Number of Questions : {{count($item->problem)}}
                        <br>
                        @foreach ($item->problem as $prob)
                            <a href="{{route('problem.edit' ,$prob->id)}}">
                                        <span class="btn__text">
                                            {{$prob->name}}
                                        </span>
                            </a>
                        @endforeach
                        </small>
                        <div class="text-right d-block">

                                    <a class="btn btn--sm" href="{{route('topic.edit' ,$item->id)}}">
                                        <span class="btn__text">
                                            Edit
                                        </span>
                                    </a>

                                    <a class="btn btn--sm btn--danger" href="{{ route('topic.index') }}" onclick="event.preventDefault();
                                document.getElementById('delete-form-{{$item->id}}').submit();">
                            <span class="btn__text">
                                            Delete
                                        </span>
                                </a>
                        <form id="delete-form-{{$item->id}}" class="" action="{{route('topic.destroy', $item->id)}}" method="post">
                            @csrf @method('DELETE')
                        </form>

                        </div>

                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</section>

<section class= "imagebg">
        {{ $topics->links() }}
</section>
</section>
@endsection
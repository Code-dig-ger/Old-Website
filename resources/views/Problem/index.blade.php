@extends('layouts.app')
@section('title')
<title>Codedigger All Problems</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">

        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >All Problems</h1>
                        Current Problems - {{$count}}
                </div>
                </div>
                            <form class="" action="{{route('problem.index') }}" method="get">

                                <div class="col-md-12">
                                    <input type="text" name="search" value=""
                                         />
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn--sm type--upercase">Search</button>
                                </div>
                            </form>
            </div>
        </div>
        <br>
        <br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <ul class="accordion accordion-2 accordion--oneopen">
                        @foreach ($problems as $item)
                        <li>
                            <div class="accordion__title">
                                <span class="h5">{{$item->name}}
                                <small>
                                    <span class="badge">
                                        {{$item->platform}}
                                    </span>
                                </small>
                                </span>
                            </div>
                            <div class="accordion__content">
                        <small>

                        Topic : {{ $item->topic["name"] }}
                        <br>
                        General Difficulty : {{ $item->generaltopic["name"] }}
                        <br>
                        Code : {{ $item->code }}
                        <br>
                        Difficulty : {{ $item->dif }}
                        <br>
                        Description : {{ $item->desc }}
                        <br>
                        </small>

                        <div class="text-right d-block">
                                    <a target="_blank" class="btn btn--sm" href="{{$item->link}}">
                                        <span class="btn__text">
                                            Link
                                        </span>
                                    </a>

                                    <a class="btn btn--sm" href="{{route('problem.edit' ,$item->id)}}">
                                        <span class="btn__text">
                                            Edit
                                        </span>
                                    </a>

                                    <a class="btn btn--sm btn--danger" href="{{ route('problem.index') }}" onclick="event.preventDefault();
                                document.getElementById('delete-form-{{$item->id}}').submit();">
                            <span class="btn__text">
                                            Delete
                                        </span>
                                </a>
                        <form id="delete-form-{{$item->id}}" class="" action="{{route('problem.destroy', $item->id)}}" method="post">
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

<div class= "imagebg">
        {{ $problems->links() }}
</div>
</section>

@endsection
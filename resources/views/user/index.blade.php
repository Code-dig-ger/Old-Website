@extends('layouts.app')
@section('title')
<title>Codedigger Users</title>
@endsection

@section('content')

<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >All Users</h1>
                        Current Users - {{$count}}
                        <br>
                        Active Today - {{$today}}
                        <br>
                        Active Yesterday - {{$yesterday}}
                        <br>
                        Active This Week - {{$week}}
                        <br>
                        Active This Month - {{$month}}
                    </div>
                </div>
                <form class="" action="{{route('users.index') }}" method="get">
                    <div class="col-md-12">
                        <input type="text" name="search" value=""/>
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
                        @foreach ($users as $item)
                        <li>
                            <div class="accordion__title">
                                <span class="h5">{{$item->name}}
                                @if($item->admin)
                                <small>
                                    <span class="badge
                                        text-success ">
                                        Admin
                                </span>
                                </small>
                                @endif
                                @if($item->is_password)
                                <small>
                                    <span class="badge
                                        text-success ">
                                        Protected
                                </span>
                                </small>
                                @endif
                                </span>
                            </div>
                            <div class="accordion__content">
                        <small>
                        Username : {{ $item->username }}
                        <br>
                        Codeforces : {{ $item->codeforces }}
                        <br>
                        Codechef : {{ $item->codechef }}
                        <br>
                        Uva : {{ $item->uva }}
                        <br>
                        SPOJ : {{ $item->spoj }}
                        <br>
                        </small>

                         <div class="text-right d-block">
                        @if($item->username == "shivamsinghal1012")

                        @else 
                            @if($item->admin)
                                <a href="" class="btn btn--sm" onclick="event.preventDefault();
                                                            document.getElementById('unshow-form-{{$item->id}}').submit();">

                                    <span class="btn__text">Remove as Admin</span>
                                </a>

                                <form id="unshow-form-{{$item->id}}" action="{{route('user.update_role', $item->id)}}" method="post">
                                    @csrf 
                                </form>
                            @else
                                <a href="" class="btn btn--sm" onclick="event.preventDefault();
                                                            document.getElementById('show-form-{{$item->id}}').submit();">
                                    <span class="btn__text">Make Admin</span>
                                </a>

                                <form id="show-form-{{$item->id}}" action="{{route('user.update_role', $item->id)}}" method="post">
                                    @csrf 
                                </form>
                            @endif
                        @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class= "imagebg">
        {{ $users->links() }}
</div>

</section>
@endsection
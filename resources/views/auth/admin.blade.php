@extends('layouts.app')

@section('title')
<title>Codedigger Secured Login</title>
@endsection

@section('content')

<section class="cover cover-fullscreen height-100 imagebg" data-gradient-bg="#4A00E0,#c471ed,#8E2DE2">
    <div class="container pos-vertical-center">
        <div class="row justify-content-center" >
            
            <div class="col-md-4 col-lg-4" >

                <form method="POST" action="{{ route('login') }}" class="row ml-auto mt-0">
                    @csrf

                        <div class="col-md-12 text-center">
                            <img alt = "codedigger" src="{{ asset('logo.png') }}" height = "150" widht = "150">
                        </div>
                        <div class="col-md-12 text-center">
                            <h3>Codedigger Secured Login</h3>
                        </div>
                        <div class="col-md-12">
                            <input placeholder="Username" type="username" name="username" value="{{$username}}"
                                required autofocus>
                        </div>

                        <div class="col-md-12">
                            <input placeholder="Password" type="password" name="password" value=""
                                required autofocus>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn--primary type--uppercase" type="submit">Login</button>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="input-checkbox">
                                <input id="checkbox" type="checkbox" name="remember" >
                                <label for="checkbox"></label>
                            </div>
                            <span>Remember me</span>

                            <br>
                            <span class="type--fine-print block" >New User?
                                <a href="{{ route('register') }}">Register</a>
                            </span>

                            <span class="type--fine-print block" >Forgot username?
                                <a href="{{ route('recover') }}">Recover account</a>
                            </span>

                            <span class="type--fine-print block" >
                            Got any issues? Contact the
                            <a href="{{route('developer')}}" style="color: #F6F7F8;"> Developer.</a>
                            </span>
                            
                        </div>
                </form>
                
            </div>
        </div>
     </div>
</section>
@endsection
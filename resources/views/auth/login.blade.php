@extends('layouts.app')
@section('title')
<title>Codedigger Login</title>
@endsection

@section('content')
<section class="cover cover-fullscreen height-100 imagebg" data-gradient-bg="#4A00E0,#c471ed,#8E2DE2">
    <div class="container pos-vertical-center">
        <div class="row justify-content-center" >
                        <div class="col-md-8 col-lg-8" >
                <div class="col-md-12 text-center">
                    <img alt = "codedigger"  title = "codedigger logo" src="{{ asset('logo.png') }}" height = "150" widht = "150">
                      <h1 class="display-4">Codedigger</h1>

                      <a href="{{route('feedback')}}"> <p>Feedback and Suggestions are most Welcome.</p>  </a>

                      <hr class = "my-4">
 
                      <p class = "lead">In Future Updates : </p>
                      <ul>
                          <li style = "font-size: 0.9em ; color: white;"> Problems on Advanced Topic such as Fenwick Tree , Trie , Suffix Array etc. will be updated soon.</li>
                          <li style = "font-size: 0.9em ; color: white;"> Upsolving is most important in competitions which guarantee success. We will help you in upsolving by suggesting some problems and solve your doubt if you stuck anywhere. </li>
                          <li style = "font-size: 0.9em; color: white;"> You can marked your favourite problems at one place , so that you can revise it later.</li>
                          <li style = "font-size: 0.9em; color: white;"> Subscribe to Youtube Channel - codealittle , we will solve your doubts by live interaction there.</li>
                      </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg-4" >

                <form method="POST" action="{{ route('middle_login') }}" class="row ml-auto mt-0">
                    @csrf
                        <div class="col-md-12 text-center">
                            <img alt = "codedigger" title = "codedigger login" src="{{ asset('icon/login.png') }}" height = "100" widht = "100">
                            <h3>Welcome Back :)</h3>
                            <small style="font-size: 0.9em; color: white;">
                                To keep practicing Problems, please login with your username.
                                <br> Keep Coding!
                            </small>
                            <hr style = "border : 1px solid white;">
                        </div>
                        <div class="col-md-12">
                            <input placeholder="Username" type="username" name="username" value=""
                                required autofocus>
                        </div>

                        <input type="hidden" name="password" value="0">

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
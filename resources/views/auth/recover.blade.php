@extends('layouts.app')
@section('title')
<title>Codedigger Recover Account</title>
@endsection

@section('content')
<section class="cover cover-fullscreen height-100 imagebg" data-gradient-bg="#4A00E0,#c471ed,#8E2DE2">
    <div class="container pos-vertical-center">
        <div class="row justify-content-center" >
            <div class="col-md-4 col-lg-4" >
                @if($account)
                        @if($user)
                            <div class="jumbotron">
                                <div class="col-md-12 text-center">
                                    <h3>Hurray!!</h3>
                                </div>
                                <div class="col-md-12">
                                    <p class="lead">We found your account.
                                        <br>
                                        Username - {{$user->username}}</p>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <a href="/login">                                    
                                        <button class="btn btn--primary type--uppercase" type="submit">Login</button>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="jumbotron">
                                <div class="col-md-12 text-center">
                                    <h3>Sorry!!</h3>
                                </div>
                                <div class="col-md-12">
                                    <p class="lead">We didn't find your account with this information.</p>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <a href="/register">                                    
                                        <button class="btn btn--primary type--uppercase" type="submit">Register</button>
                                    </a>
                                </div>
                            </div>
                        @endif
                @else
                    <form method="POST" action="{{ route('recover_account') }}" class="row ml-auto mt-0">
                        @csrf

                            <div class="col-md-12 text-center">
                                <img src="{{ asset('logo.png') }}" height = "150" widht = "150">
                            </div>
                            <div class="col-md-12 text-center">
                                <h3>Recover you Account</h3>
                            </div>
                            <div class="col-md-12">
                                <input placeholder="Enter your Codeforces Handle" type="text" name="codeforces"
                                    required autofocus>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn--primary type--uppercase" type="submit">Find my account</button>
                            </div>


                    </form>

                @endif
                <div class="col-md-12 text-center">
                    <br>
                <span class="type--fine-print block" >
                            Got any issues? Contact the
                            <a href="{{route('developer')}}" style="color: #F6F7F8;"> Developer.</a>
                            </span>


                
            </div>
        </div>
     </div>
</div>
</section>
@endsection
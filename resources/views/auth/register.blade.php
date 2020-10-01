@extends('layouts.app')
@section('title')
<title>Codedigger Register</title>
@endsection

@section('content')

<section class="cover cover-fullscreen height-100 imagebg" data-gradient-bg="#4A00E0,#c471ed,#8E2DE2">
    <div class="container pos-vertical-center">
        <div class="row justify-content-center" >
                        <div class="col-md-8 col-lg-8" >
                <div class="col-md-12 text-center">
                    <img alt = "codedigger"  title = "codedigger logo" src="{{ asset('logo.png') }}" height = "150" widht = "150">
                      <h1 class="display-4">Codedigger</h1>

                      <p>Enjoy 1K+ handpicked problems from top 4 coding sites i.e. Codeforces, Codechef, UVa and SPOJ which will improve your coding skills.</p> 

                      <hr class = "my-4">
 
                      <p class = "lead">What you can expect : </p>
                      <ul>
                          <li style = "font-size: 0.9em ; color: white;"> If you are newbie to any topic , we will provide you resources so that you can start learning. </li>
                          <li style = "font-size: 0.9em ; color: white;"> If you stuck anywhere, feel free to ask your doubt on the codealittle <a href="https://chat.whatsapp.com/GdPEOhnj7hvHs3bI9DATqN"> whatsapp group. </a>  </li>
                          <li style = "font-size: 0.9em; color: white;"> If you feel problems are tough, we will help you in all situations. </li>
                      </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg-4" >

                <form method="POST" action="{{ route('register_next') }}" class="row ml-auto mt-0">
                    @csrf

                    <div class="col-md-12 text-center">
                        <img style = "filter: invert(100%)" title = "codedigger register" alt = "codedigger" src="{{ asset('icon/user.png') }}" height = "100" widht = "100">
                            <h3>Register</h3>
                            <small style="font-size: 0.9em; color: white;">
                                We love solving doubt of new Users. 
                                <br>Welcome to Codedigger Family.
                            </small>
                            <hr style = "border : 1px solid white;">
                        </div>
                        <div class="col-md-12">
                                <input placeholder = "Your Awesome Name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-12">
                                <input id="username" placeholder = "Enter unique Username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-12">
                                <input id="codeforces" placeholder = "Enter your Codeforces Handle" type="text" class="form-control @error('codeforces') is-invalid @enderror" name="codeforces" value="{{ old('codeforces') }}"  required autocomplete="username">

                                @error('codeforces')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>                        

                        <div class="col-md-12">
                            <button class="btn btn--primary type--uppercase" type="submit">Register</button>
                        </div>

                        <span class="col-md-12 text-center type--fine-print block" >
                            Got any issues? Contact the
                            <a href="{{route('developer')}}" style="color: #F6F7F8;"> Developer.</a>
                            </span>


                </form>
            
            </div>
        </div>
     </div>
</section>
@endsection

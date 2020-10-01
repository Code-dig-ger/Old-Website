@extends('layouts.app')

@section('title')
<title>Codedigger Register Next Step</title>
@endsection

@section('content')
<section class="cover cover-fullscreen height-100 imagebg" data-gradient-bg="#4A00E0,#c471ed,#8E2DE2">
    <div class="container pos-vertical-center">
        <div class="row justify-content-center" >

            <div class="col-md-8 col-lg-8" >
                <div class="col-md-12 text-center">
                    <img alt = "codedigger" src="{{ asset('logo.png') }}" height = "150" widht = "150">
                      <h1 class="display-4">Codedigger</h1>

                      <p >Why Codechef? <br>
                  Codechef is Indian Platform which host three featured contests every month, ICPC India and SnackDown.<br> Why SPOJ? <br> This site contains a list of Interesting Classical Problems. <br> Why UVa? <br> This Site contains problems from past ICPC contests and one of the best competitive book <br>"Competitive Programming 3"  </p>
                      <hr class = "my-4">
                </div>
            </div>

            <div class="col-md-4 col-lg-4" >

                <form method="POST" action="{{ route('register') }}" class="row ml-auto mt-0">
                    @csrf

                        <div class="col-md-12 text-center">
                            <img style = "filter: invert(100%)" alt = "codedigger" src="{{ asset('icon/user.png') }}" height = "100" widht = "100">
                            <h3>Next Step (optional)</h3>
                            <small style="font-size: 0.9em; color: white;">
                                Enter your handle to access the questions from these sites.
                                You can add single or all handles. Optional for you.
                            </small>
                            <hr style = "border : 1px solid white;">
                        </div>

                        <input id="name" type="hidden" name="name" value="{{ old('name') ? old('name') : $user['name'] ?? 'guest' }}">
                        <input id="username" type="hidden" name="username" value="{{ old('username') ? old('username') : $user['username'] ?? 'shivamsinghal1012' }}">
                        <input id="codeforces" type="hidden" name="codeforces" value="{{ old('codeforces') ? old('codeforces') : $user['codeforces'] ?? 'guest' }}">

                        <div class="col-md-12">
                                <input id="codechef" placeholder = "Enter your Codechef Handle" type="text" name="codechef" value="{{ old('codechef') }}" class="form-control @error('codechef') is-invalid @enderror" autocomplete="username">
                                @error('codechef')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-12">
                                <input id="uva" placeholder = "Enter your UVa Handle" type="text" name="uva" value="{{ old('uva') }}"  class="form-control @error('uva') is-invalid @enderror" autocomplete="username">
                                @error('uva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-12">
                                <input id="spoj" placeholder = "Enter your SPOJ Handle" type="text" name="spoj" value="{{ old('spoj') }}" class="form-control @error('spoj') is-invalid @enderror" autocomplete="username">
                                @error('spoj')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn--primary type--uppercase" type="submit">Save Info and Continue</button>
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

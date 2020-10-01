@extends('layouts.app')

@section('title')
<title>Codedigger</title>
@endsection

@section('content')
<section class="cover cover-fullscreen height-100 imagebg" data-gradient-bg="#4A00E0,#c471ed,#8E2DE2">
    <div class="container pos-vertical-center">
        <div class="row justify-content-center" >

            <div class="col-md-8 col-lg-8" >
                <div class="col-md-12 text-center">
                    <br>
                    <br>
                    <br>
                    <br>
                      <h1 class="display-4">Welcome to Codedigger</h1>

                      <p>Codedigger provides you handpicked problems from top 4 coding sites i.e. Codeforces, Codechef, UVa and SPOJ which will increase your versatility in competitive programming.</p> 

                      <hr class = "my-4">
 
                      <p class = "lead">Key Features : </p>
                      <ol >
                          <li style = "font-size: 0.9em ; color: white;"> All the Topics ladders starts with basic level question to top level and next problem is locked until you solved current one.</li>
                          <li style = "font-size: 0.9em ; color: white;"> Before starting any topic you can also learn some amazing techniques on that topic through video editorials beforehand. </li>
                          <li style = "font-size: 0.9em; color: white;"> After solving the complete ladder of a topic you can you can test your knowledge by doing a virtual contest based on that topic and a video editorial will also be given so you won't get stuck and further learn new concepts.</li>
                      </ol>
                </div>
            </div>

            <div class="col-md-4 col-lg-4" >

                 <div class="col-md-12 text-center">

                    <img alt = "codedigger"  title = "codedigger logo" src="{{ asset('logo.png') }}" height = "150" widht = "150">

                            <span class="type--fine-print block" >Already User of Codedigger?
                                
                                <a class = "btn btn--sm" href="{{ route('login') }}">
                                <span class="btn__text">
                                            Login
                                        </span></a>
                            </span>
                            <br>
                            <span class="type--fine-print block" >New User?
                                
                                <a class = "btn btn--sm" href="{{ route('register') }}">
                                <span class="btn__text">
                                            Register
                                        </span></a>
                            </span>
                            <br>

                            <span class="type--fine-print block" >Use Codedigger as Guest?
                                <br>
                                <br>
                                <a class = "btn btn--sm" href="{{ route('practice.topicwise.index') }}">
                                <span class="btn__text">
                                            Practice Topicwise Problems 
                                        </span></a>
                                        <br>
                                        <br>
                                        <a class = "btn btn--sm" href="{{ route('practice.general.index') }}">
                                <span class="btn__text">
                                            Practice Levelwise Problems
                                        </span></a>
                            </span>
                            <br>

                            <span class="type--fine-print block" >Got any issue?
                                <br>
                                <a class = "btn btn--sm" href="{{ route('developer') }}">
                                <span class="btn__text">
                                            Contact the Developer
                                        </span></a>
                            </span>
                            
                </div>
            
            </div>
        </div>
     </div>
</section>

@endsection

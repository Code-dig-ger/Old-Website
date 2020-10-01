@extends('layouts.app')

@section('title')
<title>Codedigger | Dashboard</title>
@endsection

@section('content')
<section class="cover imagebg" data-gradient-bg="#83a4d4,#b6fbff">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div><h1 style="font-family: 'Metal Mania', sans-serif; margin-bottom:0; font-size:6rem;"> Dashboard </h1>
                </div>
                <div class="boxed boxed--border border--round box-shadow">
                    <div class="text-block">
                        <h5>New Update!</h5>
                        <p>
                            Upsolving ~ Solving problems after the end of the contest.
                            Most of us forgot to do that or leave thinking solve it later, Now You can Check Problems to Upsolve from past contest whether Rated or Virtual. Must do these Problems. It will help you to increase your Rating.
                            <br>    
                            Wrong Attempt - Problems that you attempt but didn't solve for AC. Review that problem, try to solve. If this problem is from any Contest (Must Solve).
                            <br>
                            <small>If you face any type of problem regarding website. Please contact me. I will try to solve it by 24hrs.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->

<section class="switchable switchable--switch feature-large">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="switchable__text">
                    <div class="text-block">
                        <h2>Roadmap For Competitive Programming!</h2>
                        <span>Having a definite path to follow is a blessing for the journey so here we present you a roadmap to start of your competitive programming journey. </span>
                    </div>
                    <p class="lead">
                        Happy Coding!!
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/VbMtwluH980" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
<section class="switchable switchable--switch feature-large">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="switchable__text">
                    <div class="text-block">
                        <h2>Prestigious Programming Contests!</h2>
                        <span> Do Participate in all these contest - Facebook HackerCup, Google CodeJam, Google KickStart, Google HashCode, ICPC, SnackDown and more...... Compete with coders from all around the world. A chance to show your coding skills to the World. </span>
                    </div>
                    <p class="lead">
                        Happy Coding!!
                        <br>
                        <small>Sorry , if i miss any contest name.</small>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/yx-3TvbSgZk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
<section class="switchable switchable--switch feature-large">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="switchable__text">
                    <div class="text-block">
                        <h2>Competitive programming from scratch.</h2>
                        <span>Are you a beginner? Then these videos are especially for you, covers all the must required algorithms and data structures for every topic with full explaination.</span>
                    </div>
                    <p class="lead">
                        Happy Coding!!
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PL1oKdRlSbldNkPnXvOU-QEPStObdRp2Zs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
</section>
@endsection

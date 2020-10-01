@extends('layouts.app')
@section('title')
<title>Codedigger Wrong Attempt Problems</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
    <div class="container text-center">
      <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;">Upsolving Problems</h1></div>
                <strong><p>
                    Problems that you attempt on Codeforces but not Accepted i.e. Wrong Attempt
                </p></strong>
            </div>
            <div class="masonry imagebg">
            <div class="card card-1 boxed boxed--sm ">
                <div class="card__top">
                    <div class="card__avatar">
                        <span>
                            <strong>Sort By?</strong>
                        </span>
                    </div>
                </div>
                <div class="card__body">
                    @if($sortBy == "rating")
                    <a class="btn btn--sm" href="{{route('upsolve.wrong')}}?sortBy=latest">
                        <span class="btn__text">Latest Attempt</span>
                    </a>
                    @else
                    <a class="btn btn--sm" href="{{route('upsolve.wrong')}}?sortBy=rating">
                        <span class="btn__text">Problem Rating</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
      </div>
        <!--end of row-->
    </div>
    <!--end of container-->

@if(count($problems))
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div id="myBtnContainer">
                  <button class="btn active btn--sm" onclick="filterSelection('all')"> All</button>
                  <button class="btn btn--sm" onclick="filterSelection('contest')"> Contest </button>
                  <button class="btn btn--sm" onclick="filterSelection('practice')"> Practice</button>
                </div>
                <br>
                <div class="column contest">
                  Contest Problems contains Problems that are submitted wrong in Contest (Rated or Virtual)
                  <br>(Must Solved This to Improve).
                </div>
                <div class="column practice">
                  Practice Problems contains Problems that are submitted wrong while Practice.
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12 col-lg-10">
                    <div class="masonry imagebg">
                        @foreach($problems as $problem)
                        <div class="column @if($problem['participantType'] == 'PRACTICE') practice @else contest @endif">
                        <div class="masonry__container row">
                            <div class="col-md-6 masonry__item">
                                <div class="card card-1 boxed boxed--sm boxed--border">
                                    <div class="card__top">
                                        <div class="card__avatar">
                                            <span>
                                                <strong>{{$problem['index']}}. {{ $problem['name'] }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                                <a target = "_blank" class="btn btn--sm" href="https://codeforces.com/contest/{{$problem['contestId']}}/problem/{{$problem['index']}}">
                                            <span class="btn__text">Solve</span>
                                        </a>                                        
                                    </div>
                                    <div class="card__bottom">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <div class="card__action">
                                                    <span>Rating - @foreach ($problem as $key => $value) 
                                        @if($key == "rating")
                                        {{$value}}
                                        @endif
                                      @endforeach</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-1 masonry__item">
                                <div class="boxed boxed--sm">
                                    <div>
                                      <small>Tag - 
                                        <br>
                                        @foreach( $problem["tags"] as $tag)
                                        {{$tag}},  
                                        @endforeach
                                      </small>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@else

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                Sorry, No Problems Available!
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->

@endif
</section>



<script type="text/javascript">
    document.title = "Codedigger | Wrong Attempt Problems";
filterSelection("all") // Execute the function and show all columns
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
@endsection
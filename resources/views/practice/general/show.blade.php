@extends('layouts.app')
@section('title')
<title>Codedigger {{$level->name}} Level Practice Problems</title>
@endsection

@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;">{{$level->name}} Level Problems</h1></div>
                @if(!auth()->user())
                <br>
               <span class="type--fine-print block" >Login to see whether you solved a particular problem or not? 
                                <br>
                                <br>
                                <a class = "btn btn--sm" href="{{ route('login') }}">
                                <span class="btn__text">
                                            Login
                                        </span></a>
                            </span>
                            @endif
                
            </div>
        </div>
        <!--end of row-->
    </div>
    <br>
    <br>
    <!--end of container-->
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div id="myBtnContainer">
                  <button class="btn active btn--sm" onclick="filterSelection('all')"> All</button>
                  <button class="btn btn--sm" onclick="filterSelection('not')"> Unsolved</button>
                  <button class="btn btn--sm" onclick="filterSelection('solved')"> Solved</button>
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
                        <div class="column @if(auth()->user() && (auth()->user()->problem->find($problem->id) || $current->search($problem->id))) solved @else not @endif ">

                        <div class="masonry__container row">
                           
                            <div class="col-md-6 masonry__item">
                                <div class="card card-1 boxed boxed--sm boxed--border">
                                    <div class="card__top">
                                        <div class="card__avatar">
                                            <span>
                                                <strong>{{ $problem->name }}</strong>
                                            </span>
                                            @if(auth()->user() && (auth()->user()->problem->find($problem->id) || $current->search($problem->id)))
                                                <small>
                                                <span class="badge">
                                                    Solved
                                                </span>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        @if(auth()->user() && (auth()->user()->problem->find($problem->id) || $current->search($problem->id)) )
                                                <a target = "_blank" class="btn btn--sm" href="{{ $problem->link }}">
                                            <span class="btn__text">Visit Again?</span>
                                        </a>
                                            @else
                                        <a target = "_blank" class="btn btn--sm" href="{{ $problem->link }}">
                                            <span class="btn__text">Solve</span>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="card__bottom">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <div class="card__action">
                                                    <span>{{ $problem->desc }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-1 masonry__item">
                                <div class="boxed boxed--sm">
                                    <div>
                                        <small>Platform </small>
                                        <br>
                                        <h3 class="d-inline">{{ ucfirst($problem->platform) }}</h3>
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
    <div class = "imagebg">
        {{ $problems->links() }}
    </div>

</section>

<script type="text/javascript">
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

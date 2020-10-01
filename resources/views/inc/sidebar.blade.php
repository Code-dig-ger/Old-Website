<div class="nav-container nav-container--sidebar">
    <div class="nav-sidebar-column bg--dark">
        <div class="text-center text-block">
            <a href="{{ route('dashboard') }}">
                <img alt="avatar" src="{{ asset('logo.png') }}" class="image--md" />
            </a>
            <div class="text-center space--xs mt-1">
                <div>
                    <span class="type--fine-print type--fade">
                        Codedigger
                        <br>
                <small>Copyright &copy; {{date("Y")}}, <a href="/">Codedigger</a>. All Rights Reserved</small>
                    </span>
                </div>
                <ul class="social-list list-inline list--hover ml-auto mt-3 mb-1 mr-auto">
                    <li>
                        <a target = "_blank" class="text-white" href="http://codeforces.com/profile/{{auth()->user()->codeforces}}">
                            <img src = "{{asset('icon_cf.jpg')}}" width="30" height="30" > 
                        </a>
                    </li>
                    <li>
                        <a target = "_blank" class="text-white" href="https://www.codechef.com/users/{{auth()->user()->codechef}}">
                            <img src = "{{asset('icon_cc.jpg')}}" width="30" height="30" > 
                        </a>
                    </li>
                    <li>
                        <a target = "_blank" class="text-white" href="https://onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&page=show_authorstats&userid={{auth()->user()->uvaid}}">
                            <img src = "{{asset('icon_uva.jpg')}}" width="30" height="30" > 
                        </a>
                    </li>
                    <li>
                        <a target = "_blank" class="text-white" href="https://www.spoj.com/users/{{auth()->user()->spoj}}">
                            <img src = "{{asset('icon_spoj.jpeg')}}" width="30" height="30" > 
                        </a>
                    </li>
                </ul>
                <div class="text-center">
                    <span class="type--fade">
                        <small>
                            Got any issues? Contact the
                            <a href="{{route('developer')}}" style="color: #F6F7F8;"> Developer.</a>
                        </small>
                    </span>
                </div>
            </div>
        </div>

        <div class="text-block">
            <h4 class="mb-0">
                {{ auth()->user()->name }}
            </h4>
            <small>
                <span data-tooltip="View or Edit your details."><a  href="{{route('user.edit')}}">
                        <strong>Edit your details</strong>
                    </a>
                </span>
                <br>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" style="color: #F6F7F8;">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </small>
            <hr>
        </div>
        <div class="text-block">
            <ul class="menu-vertical">
                <li>
                    <a class="text-white" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                        <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Ladders
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('ladders.topicwise.index')}}">
                                                Topicwise
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('ladders.general.index')}}">
                                                Levelwise
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Practice
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('practice.topicwise.index')}}">
                                                Topicwise
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('practice.general.index')}}">
                                                Levelwise
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Upsolve
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('upsolve.index')}}">
                                                Rated Contest
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('upsolve.virtual')}}">
                                                Virtual Contest
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('upsolve.wrong')}}">
                                                Wrong Attempt
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                
                @if(auth()->user()->admin)

                <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Problem
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('problem.index')}}">
                                                All Problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('problem.create')}}">
                                                Create new
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Suggested Problems
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Topic
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('topic.index')}}">
                                                All Topics 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('topic.create')}}">
                                                Create new
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Suggested Topics 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>


                    <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Level
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('Generaltopic.index')}}">
                                                All Levels
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('Generaltopic.create')}}">
                                                Create new
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                    <a class="text-white" href="{{ route('users.index') }}">
                        All Users
                    </a>
                </li>
                <li class="dropdown">
                            <span class="dropdown__trigger">
                                    Feedback
                                </span>
                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <ul class="menu-vertical">
                                        <li>
                                            <a href="{{route('feedback')}}">
                                                Form
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('feedback_response')}}">
                                                Response
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                @else
                <!--<li>
                     <a class="text-white" href="{{ route('dashboard') }}">
                        Suggest a Problem
                    </a> 
                </li> -->
                 <li>
                    <a class="text-white" href="{{ route('feedback') }}">
                        Feedback
                    </a> 
                </li>
                @endif

               

            </ul>
            
        </div>
    </div>
    <div class="nav-sidebar-column-toggle visible-xs visible-sm" data-toggle-class=".nav-sidebar-column;active">
        :)
    </div>

</div>

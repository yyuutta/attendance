<header id="header">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('users.index')}}">FB</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        {{-- <li>{!! link_to_route('users.index', 'Users') !!}</li> --}}
                        <li class="dropdown">
                            {{-- <ul class="dropdown-menu"> --}}
                                <li>{!! link_to_route('posts.index', Auth::user()->name) !!}</li>
                                @if(Auth::user()->authority == 1)
                                    <li>{!! link_to_route('login', 'Login') !!}</li>
                                    <li>{!! link_to_route('signup.get', 'Signup') !!}</li>
                                @endif
                                <li>{!! link_to_route('logout.get', 'Logout') !!}</li>
                            {{-- </ul> --}}
                        </li>
                    @else
                        {{-- <li>{!! link_to_route('signup.get', 'Signup') !!}</li> --}}
                        {{-- <li>{!! link_to_route('login', 'Login') !!}</li> --}}
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
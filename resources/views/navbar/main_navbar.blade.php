<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Blogs and News
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('blogs.index')}}">Blogs and news</a></li>
                        <li><a class="dropdown-item" href="{{route('blogs.create')}}">Create Blogs and news</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        @if(auth()->user())
            <div class="d-flex">
                <a class="nav-link active" aria-current="page" href="{{route('auth.signout')}}">Log out</a>
            </div>
        @else
                <a class="nav-link active" style="margin-right: 20px" aria-current="page" href="{{route('auth.login')}}">Sign in</a>
                <a class="nav-link active" aria-current="page" href="{{route('auth.register')}}">Sign up</a>
        @endif

    </div>
</nav>

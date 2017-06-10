<nav class="navbar navbar-toggleable-md fixed-top navbar-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Game of Toasts</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/users/view') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/reporting') }}">Reporting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/meetings') }}">Meetings</a>
            </li>
            @if (isSuperAdminUser())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/points') }}">Points</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false" id="dropdown01"
                    aria-haspopup="true">
                        {{ Auth::user()->getFullNameAttribute() }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
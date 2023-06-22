<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('home') }}">WinterMovie</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <form class="form-inline" action="{{ route('search') }}" method="GET">
          <input class="form-control form-control-sm" type="search" name="query" placeholder="Search movie" aria-label="Search">
        </form>
      </li>
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
      </li>
      @endauth
    </ul>
    <span class="navbar-text">
      @guest
        Login first
      @endguest
      @auth
        Welcome, <a href="{{route ('user.cabinet')}}">{{ Auth::user()->name }}</a>
      @endauth
    </span>
  </div>
</nav>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">Bienvenu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="{{-- {{ route('user.university.index') }} --}}">Hôtels
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
        </ul>
        {{-- <form class="d-flex">
          <input class="form-control me-sm-2" type="search" placeholder="Search" readonly>
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form> --}}
        <li class="nav-item dropdown d-flex mx-5" style="color: white;">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Autres options</a>
            <div class="dropdown-menu">
              @guest
                <a class="dropdown-item" href="{{ route('login') }}">Se connecter</a>
                <a class="dropdown-item" href="{{ route('register') }}">Créer un compte</a>
              @endguest
              @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('post')
                    <button type="subbmit" style="background: dark">Se déconnecter</button>
                </form>
              @endauth
            </div>
        </li>
      </div>
    </div>
  </nav>

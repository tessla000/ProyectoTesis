<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Terra Nostra Chile') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categoria.index') }}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('marca.index') }}">Marcas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('producto.index') }}">Productos</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('direccion.index') }}">Direccion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('info.index') }}">Datos</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cart.checkout')}}">
                        <i class="fa fa-shopping-cart"></i> Productos En Carro
                        <span class="badge badge-light">{{Cart::getTotalQuantity()}}</span>
                    </a>
                </li>
                @auth
                @if(Auth::user()->rol_id == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuario.index') }}">Usuarios</a>
                </li>
                @endif
                @endauth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sobre Nosotros</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                      <a class="dropdown-item" href="{{ route('about') }}">About</a>
                      <a class="dropdown-item" href="{{ route('contact') }}">Contact</a>
                      @auth
                      <a class="dropdown-item" href="#">{{ Auth::user()->rol->name }}</a>
                      @endauth
                  </div>
              </li>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
                @if(Auth::user()->confirmed)
                <a class="dropdown-item" href="{{ route('home', ['mode' => true]) }}">Modo Usuario</a>
                @endif
            </div>
        </li>
        @endguest
    </ul>
</div>
</div>
</nav>
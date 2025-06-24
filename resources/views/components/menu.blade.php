<style>
    .navbar {
        background: linear-gradient(to right, #ffffff 5%, #9ac0fa);
    }

    /*.navbar a {
        font-weight: bold;
    }*/
    /*.navbar li :hover{
        font-weight: bold;
    }*/
    .navbar .nombre{
        font-weight: bold;
    }
    
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('nuevo') }}">
            <img src="{{ asset('storage/imagenes/logoABG.webp') }}" class="img-fluid rounded-top" alt="GRUPO ABG" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nuevo" href="{{ route('nuevo') }}">Nuevo ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link abiertos" aria-current="page" href="{{ route('tickets') }}">Tickets abiertos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link historial" href="{{ route('historial') }}">Historial de tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link directorio" href="{{ route('usuarios') }}">Directorio</a>
                </li>

                @if (Session::get('administrador'))
                    <span class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle administrar" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item usuarios" href="{{ route('usuarios') }}">Usuarios</a></li>
                            <li><a class="dropdown-item reportes" href="{{ route('verReportes') }}">Reportes</a></li>
                            <li><a class="dropdown-item empresas" href="{{ route('verEmpresas') }}">Empresas</a></li>
                        </ul>
                    </span>
                @endif

            </ul>
            <span class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nombre" href="" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Hola {{ Session::get('nombre') }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('mi_informacion') }}">Mi información</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                </ul>
            </span>
        </div>
    </div>
</nav>
<hr style="">

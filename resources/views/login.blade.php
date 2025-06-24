@extends('layout.app')

@section('content')
    <style>
        main {
            margin-top: 0;
        }
    </style>
    <!--login-->
    <section class="vh-100" style="background-color: #508bfc;">

        <div class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="justify-content-center align-items-center card shadow-2-strong" style="border-radius: 1rem;">

                        <form action="{{ url('/aunt') }}" method="POST" class="card-body p-5 text-center">
                            @csrf
                            <!--usuario y contraseña no validos-->

                            @if (isset($error))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <div>

                                        @switch($error)
                                            @case('contraseña')
                                                Usuario o contraseña no validos
                                            @break

                                            @case('inactivo')
                                                usuario inactivo
                                            @break

                                            @default
                                                Error desconocido, contacte a soporte
                                            @break
                                        @endswitch

                                    </div>
                                </div>
                            @endif

                            <div class="container-fluid"><!--logo-->
                                <img src="{{ asset('storage/imagenes/logoABG.webp') }}" class="img-fluid rounded-top"
                                    alt="GRUPO ABG" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="name">Usuario</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="password">Contraseña</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg" />
                            </div>

                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block"
                                type="submit">Entrar</button>
                        </form>
                        <div class="justify-content-center align-items-center d-none" style="color: red">
                            <h3>Usuario o contraseña invalidos</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        header {
            display: none;
        }
    </style>
@endsection

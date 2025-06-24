@extends('layout.app')
<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">

@section('content')
    @php
        $datos = $datos[0];
    @endphp
    <style>
        .container {}

        h1 {
            text-align: center;
        }

        h2,
        h3 {
            margin: 0;
            padding: 0;
        }

        .datos {
            margin: auto 0 !important;
            padding: 5px 0;
        }

        .row {
            margin: 10px 0;
        }

        .info {
            box-shadow: 5px 5px 0px 0px black;
            border-radius: 10px;
            border: 1px solid #000;
            padding: 10px;
        }

        .info div {
            margin: 0;
            text-align: center
        }

        .inactivo {
            background-color: rgb(0, 0, 0);
            color: white;
        }
    </style>

    <form class="container justify-content-center align-items-center" method="POST" id="formulario"
        action="/empresas/ActualizarEmpresa">
        @csrf
        <h1>{{ $datos->nombre }}</h1>

        <div class="row g-2 justify-content-center align-items-center">
            <div class="info col-12 col-md-6 "id='estado'>
                <div class="col-12">
                    <h3>Estado</h3>
                </div>
                <div class="col-12 datos {{ $datos->activo == 0 ? 'inactivo' : '' }}" id='estadoLavel'>
                    @if ($datos->activo)
                        Activo
                    @else
                        Inactivo
                    @endif
                </div>
            </div>
        </div>

        <div class="form-check d-none">
            <input class="form-check-input " type="checkbox" value="1" name="activo" id="activo"
                {{ $datos->activo == 1 ? 'checked' : '' }} />
            <label class="form-check-label" for=""> activo </label>
        </div>


        <div class="row g-2 justify-content-center align-items-center">
            <div class="info col-12 col-md-6 ">
                <div class="col-12">
                    <h3>Usuario</h3>
                </div>
                <div class="col-12 datos">
                    <input type="text" value="{{ $datos->usuario }}" id="usuario" name="usuario" class="form-control">
                </div>
            </div>
        </div>

        <div class="row g-2 justify-content-center align-items-center">
            <div class="info col-12 col-md-6 ">
                <div class="col-12">
                    <h3>Contraseña</h3>
                </div>
                <div class="col-12 datos">
                    <input type="text" value="{{ $datos->contrasena }}" id="contrasena" name="contrasena"
                        class="form-control">
                </div>
            </div>
        </div>

        <div class="row g-2 justify-content-center align-items-center">
            <div class="info col-12 col-md-6 ">
                <div class="col-12">
                    <h3>Base de datos</h3>
                </div>
                <div class="col-12 datos">
                    <input type="text" value="{{ $datos->base_de_datos }}" id="base_de_datos" name="base_de_datos"
                        class="form-control">

                </div>
            </div>
        </div>

        <div class="row g-2 justify-content-center align-items-center">
            <div class="info col-12 col-md-6 ">
                <div class="col-12">
                    <h3>Ultima actualización</h3>
                </div>
                <div class="col-12 datos">
                    {{ $datos->updated_at }}
                </div>
            </div>
        </div>
        <input type="number" value="{{ $datos->id }}" id="id" name="id" class="d-none">

        <div class="row g-2 justify-content-center align-items-center">
            <div class=" col-12 col-md-6 " style="text-align: end;">
                <button type="submit" class="btn btn-primary" id="botonguardar">
                    Guardar
                </button>
                <button type="submit" class="btn btn-secondary d-none" id='botonCargando' disabled>
                    Cargando . . . </button>
            </div>
        </div>
    </form>
    
    <script src="{{ asset('js/cargando.js') }}"></script>
    <script src="{{ asset('js/empresa.js') }}"></script>
    
@endsection

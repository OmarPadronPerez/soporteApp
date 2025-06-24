@extends('layout.app')
<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">

@section('content')
    <style>
        .botonera div,
        .botonera form {
            margin-bottom: 10px;
            margin-top: 15px;
        }
        .navbar .administrar, .navbar .empresas {
            font-weight: bold;
        }
    </style>
    <div class="container principal">
        <div class="row justify-content-center align-items-center g-2">
            @if (isset($mensaje))
                <x-mensajes>
                    @slot('estado', $mensaje['estado'])
                    @slot('titulo', $mensaje['titulo'])
                    @slot('mensaje', $mensaje['mensaje'])
                </x-mensajes>
            @endif

            <div class="row botonera justify-content-between  align-items-between ">

                <div class="col-12 col-md-2">
                    <h2>Empresas</h2>
                </div>

                <div class="col-12 col-md-2  justify-content-center  align-items-center"
                    style="margin:  auto 0; padding:5px 0; text-align: center;">
                    <a name="" id="" class="btn btn-primary" href="/empresa/nuevaEmpresa" role="button">Nueva Empresa</a>
                </div>

                <form class="col-12 col-md-5 col-lg-3 justify-content-between  align-items-between" id="formorden" method="GET"
                    action="{{ route('verEmpresas') }}">
                    <select class="form-select form-select-lg " name="orden" id="orden" style=""
                        onchange="this.form.submit()">
                        <option value="ASC" {{ request('orden') == 'ASC' ? 'selected' : '' }}>Nombre A -> Z
                        </option>
                        <option value="DESC" {{ request('orden') == 'DESC' ? 'selected' : '' }}>Nombre Z -> A</option>
                    </select>
                </form>

            </div>

            <hr>

            <div class="col-12">

                @if (isset($datos))
                    @foreach ($datos as $dato)
                        <x-tarjetaEmpresas>
                            @slot('empresa', $dato->nombre)
                            @slot('id', $dato->id)
                            @slot('activo', $dato->activo)
                        </x-tarjetaEmpresas>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection

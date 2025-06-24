@extends('layout.app')
<style>
    .navbar .administrar {
            font-weight: bold;
        }
</style>
<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">

@section('content')
@if (isset($falla))
    {{$falla}}
@endif
    <div class="container">
        <h1>Nueva empresa</h1>
        <form class="justify-content-center align-items-center g-2" id="formulario" 
        method="POST" action="{{ url('/empresas/guardarEmpresa') }}">
        @csrf
            <div class="row">
                <div class="col-12 col-md">
                    <div class="mb-3">
                        <label for="inputEmpresa" class="form-label">Empresa</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                            placeholder="" required/>
                    </div>

                </div>
                <div class="col " style="margin: auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="on" name="activo" id="activo" checked/>
                        <label class="form-check-label" for="activo"> Activo </label>
                    </div>

                </div>
            </div>
            <div class="row"style="margin-top: 10px">
                <div class="col-12 col-md">
                    <div class="mb-3">
                        <label for="inputUsuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId"
                            placeholder="" required/>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="mb-3">
                        <label for="inputContrasena" class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="contrasena" id="contrasena" aria-describedby="helpId"
                            placeholder="" required/>
                    </div>
                </div>

            </div>

            <div class="row justify-content-start  align-items-start  g-2">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="inputBase" class="form-label">Base de datos</label>
                        <input type="text" class="form-control" name="base_de_datos" id="base_de_datos" aria-describedby="helpId"
                            placeholder="" required/>
                    </div>
                </div>
            </div>

            <div class="row justify-content-end align-items-end g-2">
                <div class="col-5 col-md-3 justify-content-end align-items-end" style="text-align: end">
                    <button type="submit" class="btn btn-primary" id="botonguardar">
                        Guardar
                    </button>
                    <button type="submit" class="btn btn-secondary d-none" id='botonCargando' disabled>
                        Cargando...</button>
                </div>
            </div>

        </form>
    </div>
    <script src="{{ asset('js/cargando.js') }}"></script>
    <script src="{{ asset('js/nuevaEmpresa.js') }}"></script>
@endsection

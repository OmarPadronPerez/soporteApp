<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">

<style>
    .inactivo {
        background-color: #aeafb4;

    }

    .administrador {
        background-color: #c0ffc9;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .card {
        box-shadow: 5px 5px 0px 0px black;
        overflow: hidden;
        border-radius: 10px;
        padding: 0px;
        border: 1px solid black;
    }

    /*areas para el titulo*/
    .DESARROLLO {
        background-color: black;
        color: white
    }

    .NOMINAS {
        background-color: #af1c8f;
        color: white
    }

    .SOPORTE {
        background-color: #002aff;
        color: white
    }

    .RRHH {
        background-color: #8828de;
        color: white;
    }

    .RECLUTAMIENTO {
        background-color: #14b407;
    }

    .VENTAS {
        background-color: #fed944;
    }

    .FINANSAS {
        background-color: #555492;
        color: white;

    }
</style>

@php
    $estilo = '';
    $estiloTitulo = $area;
    $redireccion = '';

    if (Session::get('administrador')) {
        $redireccion = 'usuarios/' . $id;
        if ($administrador) {
            $estilo .= ' administrador';
        }
    }

    if (!$activo) {
        $estilo = 'inactivo';
        $estiloTitulo = '';
    }

@endphp

@if (Session::get('administrador'))
    <a href="{{ $redireccion }}">
@else
    <div>
@endif
<div class="card {{ $estilo }}" style="overflow: hidden;">
    <div class="card-header row justify-content-start align-items-start {{ $estiloTitulo }}">

        <div class="col-4 col-lg-1">
            ID: <b>{{ $id }}</b>
        </div>

        <div class="col-10 col-lg-11">
            <b>{{ $name }}</b>
        </div>

    </div>
    <div class="card-body ">
        <div class="row justify-content-start align-items-start">
            <div class="col-7 col-lg-3 ">
                Área: <b>{{ $area }}</b>
            </div>
            @if (isset($extencion))
                <div class="col-12">
                    Extensión: <b>{{ $extencion }}</b>
                </div>
            @endif
            @if (isset($correo))
                <div class="col-12">
                    Correo: <b><a href="mailto:{{ $correo }}">{{ $correo }}</a></b>
                </div>
            @endif

            @if (Session::get('administrador'))
                @if ($activo)
                    <div class="col-6 col-lg-3">
                        Estado: <b>Activo</b>
                    </div>
                @else
                    <div class="col-6 col-lg-3" style="color: red">
                        Estado: <b>Desactivado</b>
                    </div>
                @endif
            @endif

            @if (Session::get('administrador'))
                <div class="col-12 col-lg-12 ">
                    Actualización:
                    <b>{{ date('d/M/y', strtotime($updated_at)) }}</b>
                </div>
            @endif
        </div>
    </div>
</div>
<{{ Session::get('administrador') ? '/a' : '/div' }}>

<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('css/tarjetaticket.css') }}" rel="stylesheet">

<style>
    .card {
        box-shadow: 5px 5px 0px 0px black;
        overflow: hidden;
        border-radius: 10px;
        padding: 0px;
        border: 1px solid black;
    }

    .falla {
        background-color: #f65da7;
        color:black;
    }

    .revision {
        background-color: #f4d03f;
    }

    .titulo {
        background-color: silver;
    }

    .completo {
        background-color: #a2c1ef;
    }
</style>
@php
    $estilo = '';
    if (isset($nombre_resuelto)) {
        $estilo = 'revision';
        if (isset($fecha_resuelto)) {
            $estilo = 'completo';
        }
    } else {
        $estilo = 'titulo';
    }
@endphp

<a href="{{ url($redirigir) }}" class="card {{ $Urgencia }}">

    <div class="container {{ $estilo }} ">
        @if ($afectados != 'Usuario' && $afectados != '')
            <div class="row justify-content-between align-items-center card-header falla">

                @php
                    $leyenda = '';
                    if ($afectados != 'General') {
                        $leyenda = 'Falla en area de ';
                    } else {
                        $leyenda = 'Falla ';
                    }
                @endphp
                <h5> <b>{{ $leyenda }} {{ $afectados }}</b></h5>

            </div>
        @endif
        <div class="row justify-content-between align-items-center card-header ">
            <div class="col-12">
                @if (Session::get('administrador'))
                    <h5><b>Usuario: </b>{{ $usuario }}</h5>
                @endif

            </div>
            <div class="col-12 col-md-5 ">
                <h5>
                    <b>Falla con: </b>{{ $Falla }}
                </h5>
            </div>

            <div class="col-12 col-md-5 estado">
                <h5 class="card-text">
                    <b>Estado:</b>
                    @if (isset($fecha_resuelto))
                        Cerrado
                    @else
                        @if ($nombre_resuelto != '')
                            En revisión
                        @else
                            Activo
                        @endif
                    @endif
                </h5>
            </div>
        </div>
        <div class="row justify-content-between align-items-center card-header">
            <div class="col-12 col-lg-6">
                <h5>
                    <b>Creación: </b>{{ date('d/M/y H:i', strtotime($fCreacion)) }}
                </h5>
            </div>
            @if (isset($fecha_resuelto))
                <div class="col-12 col-md-5 estado">
                    <h5 class="card-text">
                        <b>Cierre: </b>
                        {{ date('d/M/y H:i', strtotime($fecha_resuelto)) }}
                    </h5>
                </div>
            @endif
        </div>
    </div>

    <div class="card-body">
        <div class="descripcion">
            <h4 class="card-title">Descripción del problema</h4>
            <p class="card-text">
                {{ $Descripcion }}
            </p>
        </div>
    </div>
</a>

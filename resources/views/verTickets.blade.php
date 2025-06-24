@extends('layout.app')

<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">

@section('content')
    <style>
        .boton {
            margin: 10px;
        }

        .card {
            padding: 0px;
        }

        .revision {
            background-color: #f4d03f;
        }

        nav .abiertos {
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

            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-8">
                    <h2>Tickets abiertos</h2>
                </div>
                <div class="col-12 col-md-4">
                    <form class="mb-3" id="formorden" method="GET" action="{{ route('tickets') }}">
                        <select class="form-select form-select-lg" name="orden" id="orden" style=""
                            onchange="this.form.submit()">
                            <option value="ASC" {{ request('orden') == 'ASC' ? 'selected' : '' }}>Antiguo primero
                            </option>
                            <option value="DESC" {{ request('orden') == 'DESC' ? 'selected' : '' }}>Nuevo primero</option>
                        </select>
                    </form>
                </div>
            </div>
            <hr>

            <div class="col-12">
                @if (isset($datos))
                    @foreach ($datos as $dato)
                        @php
                            $nombre = $dato->creador_name . ' ' . $dato->creador_lastName;

                            if (isset($dato->resuelto_name)) {
                                $resuelto = $dato->resuelto_name . ' ' . $dato->resuelto_lastName;
                            } else {
                                $resuelto = null;
                            }
                        @endphp

                        <x-tarjeta>
                            @slot('id', $dato->id)
                            @slot('afectados',$dato->afectados)
                            @slot('usuario', $nombre)
                            @slot('fCreacion', $dato->created_at)
                            @slot('Falla', $dato->Falla)
                            @slot('Descripcion', $dato->Detalles)
                            @slot('redirigir', 'tickets/' . $dato->id)
                            @slot('Urgencia', $dato->Urgencia)
                            @slot('nombre_resuelto', $resuelto)
                        </x-tarjeta>
                    @endforeach

                    {{ $datos->links('pagination::bootstrap-5') }}
                @else
                    <h3>Sin tickets que mostrar</h3>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/refrescar.js') }}"></script>

@endsection

@extends('layout.app')

<link type="text/css" href="{{ asset('css/estilos.css') }}" rel="stylesheet">
<style>
    select {
        padding: 0;
        margin: 0;
    }

    nav .historial {
        font-weight: bold;
    }
</style>

@section('content')
    <div class="container principal">
        <div class="row justify-content-center align-items-center g-2">
            @if (isset($mensaje))
                <x-mensajes>
                    @slot('estado', $mensaje['estado'])
                    @slot('titulo', $mensaje['titulo'])
                    @slot('mensaje', $mensaje['mensaje'])
                </x-mensajes>
            @endif
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12 col-md-8">
                    <h2>Tu Historial</h2>
                </div>
                <div class="col-12 col-md-4">
                    <form class="mb-3" id="formorden" method="GET" action="{{ route('historial') }}">
                        <select class="form-select form-select-lg " name="orden" id="orden" style=""
                            onchange="this.form.submit()">
                            <option value="DESC" {{ request('orden') == 'DESC' ? 'selected' : '' }}>Nuevo Primero</option>
                            <option value="ASC" {{ request('orden') == 'ASC' ? 'selected' : '' }}>Antiguo Primero
                            </option>


                        </select>
                    </form>

                </div>

            </div>
            <hr>
            <div class="col-12">
                @if ($datos)
                    @foreach ($datos as $dato)
                        @php
                            $nombre = $dato->name . ' ' . $dato->lastName;
                            $redirigir = '';
                            if ($dato->fecha_resuelto) {
                                $redirigir = 'completo/' . $dato->id;
                            } else {
                                $redirigir = 'tickets/' . $dato->id;
                            }
                        @endphp

                        <x-tarjeta>
                            @slot('id', $dato->id)
                            @slot('usuario', $nombre)
                            @slot('afectados',$dato->afectados)
                            @slot('fCreacion', $dato->created_at)
                            @slot('fecha_resuelto', $dato->fecha_resuelto)
                            @slot('Falla', $dato->Falla)
                            @slot('Descripcion', $dato->Detalles)
                            @slot('redirigir', $redirigir)
                            @slot('Urgencia', $dato->Urgencia)
                        </x-tarjeta>
                    @endforeach
                @else
                    <h3>sin tikets que mostrar</h3>
                @endif

            </div>
        </div>
    </div>
@endsection

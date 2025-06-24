@extends('layout.app')
@section('content')
    <style>
        .btn-excel {
            background-color: #10793f;
            border: none;
        }

        .botones {
            margin: auto 0;
        }

        .botones a {
            margin: 0 10px;
        }

        .fechas input {
            margin: 0 10px;
        }

        form div {
            margin: auto 0;
        }

        .no_permitido {
            border-color: red;
        }
        .navbar .administrar, .navbar .reportes{
            font-weight: bold;
        }
    </style>
    <div class="container">

        <div class="row justify-content-center align-items-center g-2">
            <h2 class="col">Reportes</h2>
        </div>
        <form class="row g-2" action="{{ route('verReportes') }}" style="margin: auto" method="GET">
            @csrf
            <div class="col-auto fechas">
                Reporte de
                <input type="date" id="fecha_inicio" value='{{ $fInicio }}' name="fecha_inicio" class='no_permitido'>
                a
                <input type="date" id="fecha_fin" value='{{ $fFin }}' name="fecha_fin" class='no_permitido'>
            </div>

            <div class="col-auto botones">
                <button type="submit" id='btnBuscar' class="btn btn-primary">
                    Buscar
                </button>

                <a name="" id="" class="btn btn-primary btn-excel" 
                href="{{ route('reportesxslx', ['inicio' => $fInicio, 'fin' => $fFin]) }}" role="button">
                    Exportar a Excel
                </a>
            </div>
        </form>

        <div class="row justify-content-center align-items-center g-2" style="margin-top: 5px">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fecha de inicio</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Falla</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Atendido por</th>
                                <th scope="col">Urgencia</th>
                                <th scope="col">Fecha de cierre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $dato)
                                @php
                                    $estilo = '';
                                    if (!isset($dato->fecha_resuelto)) {
                                        $estilo = 'table-warning';
                                    }
                                    // Crear el nombre del creador
                                    $creador = '';
                                    $nombrecadena = explode(' ', $dato->creador_lastName);
                                    // Si tiene 2 palabras en el apellido, toma la segunda, si no, la única
                                    if (count($nombrecadena) > 2) {
                                        $creador = $nombrecadena[1];
                                    } else {
                                        $creador = $nombrecadena[0];
                                    }
                                    // Si tiene 2 nombres, toma el primero
                                    $nombrecadena = explode(' ', $dato->creador_name);
                                    $creador .= ' ' . $nombrecadena[0];

                                    // Crear el nombre del que resolvió
                                    $resuelto = '-';
                                    if (isset($dato->resuelto_name)) {
                                        $nombrecadena = explode(' ', $dato->resuelto_lastName);
                                        if (count($nombrecadena) > 2) {
                                            $resuelto = $nombrecadena[1];
                                        } else {
                                            $resuelto = $nombrecadena[0];
                                        }
                                        $nombrecadena = explode(' ', $dato->resuelto_name);
                                        $resuelto .= ' ' . $nombrecadena[0];
                                    }
                                    $fecha_resuelto = '';
                                    if (isset($dato->fecha_resuelto)) {
                                        $fecha_resuelto = date('d/m/Y H:i', strtotime($dato->fecha_resuelto));
                                    }
                                @endphp

                                <tr class="{{ $estilo }}">
                                    <td scope="row">{{ $dato->id }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($dato->created_at)) }}</td>
                                    <td>{{ $creador }}</td>
                                    <td>{{ $dato->Falla }}</td>
                                    <td>{{ $dato->Detalles }}</td>
                                    <td>{{ $resuelto }}</td>
                                    <td>{{ $dato->Urgencia }}</td>
                                    <td>{{ $fecha_resuelto }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/reportes.js') }}"></script>
@endsection

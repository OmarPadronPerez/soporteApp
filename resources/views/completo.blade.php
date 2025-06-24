@extends('layout.app')

@section('content')
    <link type="text/css" href="{{ asset('css/general.css') }}" rel="stylesheet">

    <style>
        .boton {
            margin: 10px;
        }

        .borde {
            border: 1px solid #0d6efd;
        }

        .tarjeta {
            padding: 8px 16px;
        }

        .card,
        .diagnostico {
            overflow: hidden;
        }

        .revision {
            background-color: #f4d03f;
        }

        textarea {
            resize: none;
            border-color: black !important;
        }
    </style>

    <!--si el ticket esta cerrado selecciona el historial en el menu sino la opcion de abiertos-->
    @if ($datos[0]->fecha_resuelto)
        <style>
            .navbar .historial {
                font-weight: bold;
            }
        </style>
    @else
        <style>
            .navbar .abiertos {
                font-weight: bold;
            }
        </style>
    @endif

    @php
        $estilo = '';
        if (isset($datos[0]->resuelto_name) && !isset($datos[0]->fecha_resuelto)) {
            $estilo = 'revision';
        }
    @endphp

    <div class="container principal">
        <a name="" id="" class="btn btn-primary col-12 col-md-2" href="{{ url('/historial') }}" role="button"
            style="margin: 10px 0;"><-- Regresar </a>
                <div class="row justify-content-center align-items-center g-2">

                    <div class="card borde"style="padding: 0;">
                        @foreach ($datos as $dato)
                            <div class="card-header {{ $estilo }}">


                                <h4><b>Usuario: </b>{{ $dato->creador_name . ' ' . $dato->creador_lastName }}</h4>

                                @if (isset($dato->afectados))
                                    @if ($dato->afectados != 'Usuario')
                                        @php
                                            $leyenda = '';
                                            if ($dato->afectados != 'General') {
                                                $leyenda = 'Falla en area de ';
                                            } else {
                                                $leyenda = 'Falla ';
                                            }
                                        @endphp
                                        <h4> <b>{{ $leyenda }}</b> {{ $dato->afectados }}</h4>
                                    @endif
                                @endif

                                <h4><b>Falla con: </b>{{ $dato->Falla }}</h4>

                                <h4><b>Estado: </b>
                                    @if ($dato->fecha_resuelto)
                                        Cerrado
                                    @else
                                        En revisión
                                    @endif
                                </h4>
                                @if (isset($dato->resuelto_name))
                                    <h4><b>Atendió: </b>{{ $dato->resuelto_name . ' ' . $dato->resuelto_lastName }}</h4>
                                @endif
                            </div>
                            <div class="row card-header justify-content-between align-items-center">
                                <div class="col-12 col-lg-5">
                                    <h5>
                                        <b>Creación: </b>{{ date('d/M/y H:i', strtotime($dato->created_at)) }}
                                    </h5>
                                </div>
                                <div class="col-12 col-lg-5 estado">
                                    <h5 class="card-text">
                                        @if ($dato->fecha_resuelto)
                                            <b>Cierre: </b>{{ date('d/M/y H:i', strtotime($dato->fecha_resuelto)) }}
                                        @else
                                            @if ($dato->created_at != $dato->updated_at)
                                                <b>Última actualización: </b>
                                                {{ date('d/M/y H:i', strtotime($dato->updated_at)) }}
                                            @endif
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($dato->Falla != 'TIMBRADO')
                                    <div class="">
                                        <div class="descripcion">
                                            <h4 class="card-title">Descripción del problema</h4>
                                            <p class="card-text">
                                                @if ($dato->Detalles)
                                                    {{ $dato->Detalles }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="Datos_timbrado">
                                        <div class="table-responsive col-lg-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">Empresa</td>
                                                        <td>{{ $timbrado[0]->empresa_nombre }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Ejercicio</td>
                                                        <td>{{ $timbrado[0]->ejercicio }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Tipo de periodo</td>
                                                        <td>{{ $timbrado[0]->tipoPeriodo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Periodo</td>
                                                        <td>{{ $timbrado[0]->periodo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Empleados</td>
                                                        <td>{{ $timbrado[0]->empleados }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Tipo de servicio</td>
                                                        <td>{{ $timbrado[0]->servicio }}</td>
                                                    </tr>

                                                    @if (isset($timbrado[0]->tipo_cancelado))
                                                        @php
                                                            $tipo_cancelado = '';
                                                            switch ($timbrado[0]->tipo_cancelado) {
                                                                case 1:
                                                                    $tipo_cancelado =
                                                                        '01 -> Comprobante emitido con errores con relación';
                                                                    break;
                                                                case 2:
                                                                    $tipo_cancelado =
                                                                        '02 -> Comprobante emitido con errores sin relación';
                                                                    break;
                                                                case 3:
                                                                    $tipo_cancelado =
                                                                        '03 -> No se llevó a cabo la operación';
                                                                    break;
                                                                default:
                                                                    break;
                                                            }
                                                        @endphp

                                                        <tr>
                                                            <td scope="row">Tipo de cancelación</td>
                                                            <td>{{ $tipo_cancelado }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td scope="row">Comentarios</td>
                                                        <td>{{ $timbrado[0]->comentarios }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                    </div>
                    @if (isset($dato->Archivo))
                        <div class="col-12 card tarjeta borde">
                            <x-descargas>
                                @slot('file', $dato->Archivo)
                                @slot('id', $dato->Creador_id)
                            </x-descargas>
                        </div>
                    @endif
                    @endforeach

                    <div class="col-12 card borde" style="padding: 8px 16px;">
                        <div class="mb-4 " style="padding: 0">
                            <label for="Diagnostico" class="form-label">
                                @if ($dato->Falla != 'TIMBRADO')
                                    <h3>Diagnóstico técnico</h3>
                                @else
                                    <h3>Fallas de timbrado</h3>
                                @endif
                            </label>
                            @php
                                $diagnostico = '';
                                if (isset($dato->fecha_resuelto)) {
                                    $diagnostico = 'Resuelto sin fallas';
                                }

                                if (isset($dato->Diagnostico)) {
                                    if ($dato->Diagnostico != '') {
                                        $diagnostico = $dato->Diagnostico;
                                    }
                                }
                            @endphp
                            <textarea readonly class="form-control" name="Diagnostico" id="Diagnostico" rows="3">{{ $diagnostico }}</textarea>
                        </div>
                    </div>

                    <textarea class="form-control d-none" name="id" id="id" rows="1" hidden>{{ $datos[0]->id }}</textarea>
                    <div class="espacio" style="height: 20px"></div>
                </div>
    </div>
@endsection

@extends('layout.app')

@section('content')
    <style>
        .boton {
            margin: 10px;
        }

        .revision {
            background-color: #f4d03f;
        }

        .borde {
            border: 1px solid #0d6efd;
        }

        .tarjeta {
            padding: 8px 16px;
        }

        textarea {
            resize: none;
            border-color: black !important;
        }

        .navbar .abiertos {
            font-weight: bold;
        }
    </style>

    @if (!Session::get('administrador'))
        {{ redirect('/nuevo') }}
    @endif
    <form action="{{ url('/tckActualizar') }}" method="POST"class="container" id="formulario">
        @csrf
        @php
            $estilo = '';
            if (isset($datos[0]->resuelto_name)) {
                $estilo = 'revision';
            }
        @endphp
        <div class="row justify-content-center align-items-center g-2">
            <a name="" id="" class="btn btn-primary boton flecha" href="{{ url('/historial') }}"
                role="button"><-- Regresar </a>

                    @foreach ($datos as $dato)
                    
                        <div class="card borde" style="padding: 0px;">
                            <div class="card-header {{ $estilo }}">
                                <h5><b>Usuario: </b>{{ $dato->creador_name . ' ' . $dato->creador_lastName }}</h5>
                                @if (isset($dato->resuelto_name))
                                    <h5><b>Atiende:</b> {{ $dato->resuelto_name . ' ' . $dato->resuelto_lastName }}</h5>
                                @endif

                                <h5><b>Falla con: </b>{{ $dato->Falla }}</h5>

                                <div class="row justify-content-between align-items-between  g-2">
                                    <div class="col-12 col-md-6">
                                        <label for="prioridad" id="Prioridad" class="">
                                            <h5><b>Prioridad</b></h5>
                                        </label>
                                        <select class="form-select form-select-lg" name="prioridad" id="prioridad">
                                            <option value="Normal" {{ request('Urgencia') == 'Normal' ? 'selected' : '' }}>
                                                Normal
                                            </option>
                                            <option value="Baja" {{ request('Urgencia') == 'Baja' ? 'selected' : '' }}>
                                                Baja
                                            </option>
                                            <option value="Critica"
                                                {{ request('Urgencia') == 'Critica' ? 'selected' : '' }}>
                                                Crítica
                                            </option>
                                        </select>
                                    </div>

                                    @if ($dato->Falla != 'TIMBRADO')
                                        <div class="col-12 col-md-6">
                                            <label for="prioridad" id="" class="">
                                                <h5><b>Afectados</b></h5>
                                            </label>
                                            <select class="form-select form-select-lg" name="afectados" id="afectados">
                                                <option value="Usuario"
                                                    {{ request('afectados') == 'Usuario' ? 'selected' : '' }}>
                                                    Usuario unico</option>
                                                <option value={{ $dato->creador_area }}
                                                    {{ request('afectados') == $dato->creador_area ? 'selected' : '' }}>
                                                    Area de {{ $dato->creador_area }}
                                                </option>
                                                <option value="General"
                                                    {{ request('afectados') == 'General' ? 'selected' : '' }}>
                                                    Falla General</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card-header">
                                <h4><b>Fecha de creación: </b>{{ date('d/M/y H:i', strtotime($dato->created_at)) }}</h4>
                                @if (isset($dato->resuelto_name))
                                    <h4><b>Última actualización: </b>{{ date('d/M/y H:i', strtotime($dato->updated_at)) }}
                                    </h4>
                                @endif
                            </div>

                            @if ($dato->Falla != 'TIMBRADO')
                                <div class="card-body">
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
                                <div class="card-body">
                                    <div class="Datos_timbrado">
                                        <div class="table-responsive col-lg-5">
                                            @php
                                                $tipo_cancelado = '';
                                                switch ($timbrado[0]->tipo_cancelado) {
                                                    case '1':
                                                        $tipo_cancelado =
                                                            '01 -> Comprobante emitido con errores con relación';
                                                        break;
                                                    case '2':
                                                        $tipo_cancelado =
                                                            '02 -> Comprobante emitido con errores sin relación';
                                                        break;
                                                    case '3':
                                                        $tipo_cancelado = '03 -> No se llevó a cabo la operación';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            @endphp
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
                                                    <tr>
                                                        <td scope="row">Tipo de cancelación</td>
                                                        <td>{{ $tipo_cancelado }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Comentarios</td>
                                                        <td>{{ $timbrado[0]->comentarios }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    @if (isset($datos[0]->Archivo))
                        <div class="col-12 card tarjeta borde">
                            <x-descargas>
                                @slot('file', $dato->Archivo)
                                @slot('id', $dato->Creador_id)
                            </x-descargas>
                        </div>
                    @endif



                    @if ($dato->Falla == 'PC/mantenimiento')
                        <x-mantenimiento>
                        </x-mantenimiento>
                    @endif

                    <div class="col-12 card tarjeta borde">
                        <x-cuadro-diagnostico>
                            @slot('datoDiagnostico', $dato->Diagnostico)
                            @slot('falla', $dato->Falla)
                        </x-cuadro-diagnostico>
                    </div>



                    <div class="row justify-content-between align-items-start g-2 borde tarjeta card">
                        <h3>Estado</h3>

                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group"
                            id="botonera">
                            <input type="radio" class="btn-check " value="En revision" name="Estado" id="revisión"
                                autocomplete="off" checked />
                            <label class="btn btn-outline-primary " for="revisión">En revisión</label>

                            <input type="radio" class="btn-check" value="Concluido" name="Estado" id="Concluido"
                                autocomplete="off" />
                            <label class="btn btn-outline-primary" for="Concluido">Cerrado</label>
                        </div>
                    </div>
                    <textarea class="form-control d-none" name="id" id="id" rows="1">{{ $datos[0]->id }}</textarea>
                    <textarea class="form-control d-none" name="falla" id="falla" rows="1">{{ $datos[0]->Falla }}</textarea>

                    <button type="submit" class="btn btn-success boton" id='botonguardar'>
                        Guardar
                    </button>
                    <button type="submit" class="btn btn-secondary boton d-none" id='botonCargando' disabled>Cargando . . .
                    </button>
        </div>
    </form>

    <script src="{{ asset('js/mantenimiento.js') }}"></script>
    <script src="{{ asset('js/cargando.js') }}"></script>
@endsection

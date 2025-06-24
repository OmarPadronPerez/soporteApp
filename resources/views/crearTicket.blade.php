@extends('layout.app')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

@section('content')
    <style>
        form {
            margin-bottom: 20px;
        }

        .btnSalir {
            margin: 10px 0;
            text-align: center;
        }

        .btn_resolver {
            margin: 10px 0;
            text-align: center
        }

        .btn_confirmar div {
            width: 100%;
        }

        .btn_confirmar h3 {
            text-align: center;
        }

        .list-group-item {
            border-color: black
        }

        .faltaTimbrado {
            border: 1px solid red;
        }

        .campo3 {
            border-radius: 10px;
            border: 1px solid var(--azul-principal);
            padding: 20px 20px;
        }

        textarea {
            resize: none;
            border-color: black !important;
        }

        select {
            border-color: var(--azul-principal) !important;
        }

        nav .nuevo {
            font-weight: bold;
        }
    </style>

    <form action="{{ url('/nuevo/envtkt') }}" method="POST" enctype="multipart/form-data" class="container formulrio"
        id="formulario">
        @csrf

        @if (isset($mensaje))
            <x-mensajes>
                @slot('estado', $mensaje['estado'])
                @slot('titulo', $mensaje['titulo'])
                @slot('mensaje', $mensaje['mensaje'])
            </x-mensajes>
        @endif

        <div class="row justify-content-center align-items-center g-2">

            <div class="col">
                <h2>¿Tienes problemas? </h2>
            </div>
            <hr>

            <!--desde un controlador se envia la variable datos con los usuarios paraseleccionar el que -->
            @if (isset($datos))
                <div class="mb-3">
                    <h3> Usuario </h3>
                    <select name="usuario2" id="usuario2" class="form-select" aria-label="Default select example">
                        @foreach ($datos as $usr)
                            @if ($usr->id != 1)
                                <option value="{{ $usr->id }}">{{ $usr->name . ' ' . $usr->lastName . ' ' }}</option>
                            @endif
                        @endforeach
                        <option value="1">FALLA GENERAL</option>
                    </select>
                </div>
            @endif

            <label for="Falla1" class="form-label">
                <h3> ¿Con que tienes problemas? </h3>
            </label>

            <div class="mb-3" id="campo1">
                <select name="Falla1" id="Falla1" class="form-select" aria-label="Default select example">
                    <option value="">Seleccione una opción</option>
                    <option value="Conexion">LA CONEXIÓN</option>
                    <option value="PC">MI PC/WYSE</option>
                    <option value="Accesorios">UN ACCESORIO DE MI PC</option>
                    <option value="Aplicaciones">UNA APLICACIÓN</option>
                    <option value="Office">UN PROGRAMA DE OFFICE</option>
                    <option value="Correo">MI CORREO</option>
                    <option value="Servidor">EL SERVIDOR / MI SESIÓN</option>
                    <option value="Timbrado">TIMBRADO</option>
                    <option value="Otra_cosa">OTRA COSA</option>
                </select>
            </div>

            <div class="mb-3" id="campo2">
                <select name="Falla2" id="Falla2" class="form-select d-none" aria-label="Default select example">
                </select>
            </div>
            <!--agregar el d-none-->
            <div class="campo3 d-none" id="campo3"></div>

            <div id="divTimbrado" class="d-none row form justify-content-center align-items-center g-2">

                <div class="btn-group  justify-content-center align-items-center g-2" role="group"
                    aria-label="Basic checkbox toggle button group" id="btn_servicios" style="padding: 10px">

                    <input type="checkbox" class="btn-check" name="servicio_timbrado" value="1" id="Timbrado"
                        autocomplete="off" />
                    <label class="btn btn-outline-primary" for="Timbrado">Timbrado / Retimbrado</label>

                    <input type="checkbox" class="btn-check" value="1" name="servicio_Cancelacion" id="Cancelación"
                        autocomplete="off" />
                    <label class="btn btn-outline-primary" for="Cancelación">Cancelación</label>
                </div>

                <div>
                    <div class="mb-3 d-none" id='div_tipo_cancelado'>
                        <label for="tipo_cancelado" class="form-label">Tipo de cancelado</label>
                        <select class="form-select " name="tipo_cancelado" id="tipo_cancelado">
                            <option selected>ESCOJA UNA OPCION</option>
                            <option value="1">01 -> Comporobante emitido con errores con relacion</option>
                            <option value="2">02 -> Comporobante emitido con errores sin relacion</option>
                            <option value="3">03 -> No se llevó a cabo la operacion</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <label for="Empresa" class="form-label">Empresa</label>
                    <select class="form-select " name="Empresa" id="Empresa">
                        <option selected>SELECCIONE UNA EMPRESA</option>
                        @foreach ($empresas as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach

                    </select>

                </div>

                <div class="col-6 col-md-3">
                    <label for="Ejercicio" class="form-label">Ejercicio</label>
                    <input type="number" class="form-control" name="Ejercicio" id="Ejercicio" aria-describedby="helpId"
                        placeholder="" value="" />
                </div>

                <div class="col-6 col-md-3">
                    <label for="tipo_periodo" class="form-label">Tipo de periodo</label>
                    <select class="form-select " name="tipo_periodo" id="tipo_periodo">
                        <option value="Diario">Diario</option>
                        <option value="Semanal">Semanal</option>
                        <option selected value="Catorcenal">Catorcenal</option>
                        <option value="Quincenal">Quincenal</option>
                        <option value="Mensual">Mensual</option>
                    </select>

                </div>

                <div class="col-12 col-md-3">
                    <label for="Periodo" class="form-label">Periodo</label>
                    <input type="number" class="form-control" name="Periodo" id="Periodo" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <div class="row" style="padding:0; margin:20px 0px">
                    <label for="cb_empleados_todos" class="form-label">Empleados</label>
                    <div class="form-check col-3 col-md-2">
                        <input class="form-check-input" type="checkbox" id="cb_empleados_todos"
                            name="cb_empleados_todos" checked />
                        <label class="form-check-label" for="cb_empleados_todos" id=''> Todos </label>

                    </div>
                    <div class="col-9 col-md-9 d-none" id="formEmpleados">
                        <input type="text" class="form-control" name="formEmpleados" id="in_Empleados"
                            aria-describedby="helpId" placeholder="" />
                    </div>

                </div>

                <div class="col-12">
                    <label for="Comentarios" class="form-label">Comentarios</label>
                    <textarea class="form-control" name="Comentarios" id="Comentarios" rows="3"></textarea>
                </div>
            </div>

            <div class="col d-none btn_resolver" id="btn_resolver">
                <h2>¿Te sirvio esta informacion?</h2>

                <div class="col-12 ">
                    <div class="btn-group col" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio1" onclick="mostrar_enviar(0)">Pude
                            resolver mi problema, gracias</label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio2" onclick="mostrar_enviar(1)">no,
                            necesito mas ayuda</label>
                    </div>
                </div>
            </div>

            <div id="enviar" class='mb-3 d-none'>
                <div class="mb-3" id="">
                    <label for="detalles" class="form-label ">
                        <h3>Describenos tu falla</h3>
                    </label>
                    <textarea name="Detalles" class="form-control" id="detalles" rows="3" required></textarea>
                </div>

                <div class="mb-3" id="archivo">
                    <label for="file-input" class="form-label">
                        <h3>¿Necesitas mostrarnos algo mas?</h3>
                    </label>
                    <br>
                    <input name="file" type="file" id="file-input" enctype="multipart/form-data" />
                </div>
            </div>

            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block d-none"
                type="submit" id="botonguardar">Guardar</button>

            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block d-none"
                id="botonCargando" disabled>Cargando . . .</button>

        </div>
    </form>
    <div class="col-12 btnSalir d-none" id="btnSalir">
        <a name="" class="btn btn-primary col-6" href="/tickets" role="button">Salir</a>
    </div>




    <script src="{{ asset('js/crearticket.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection

@extends('layout.app')

@section('content')
    <style>
        h2 {
            text-align: center;
        }

        .principal {
            min-height: 100vh;
        }

        form {
            margin: auto;
        }

        .campo {
            width: 100%;
        }

        input {
            background: none;
            border: none;
            width: 100%;
        }

        select {
            display: inline !important;
        }

        .row {
            margin: 5px 0;
        }

        .tarjeta {
            box-shadow: 5px 5px 0px 0px #0f4655;
            overflow: hidden;
            border-radius: 10px;
            padding: 0px;
            border: 1px solid black;
        }

        .tarjetainfo {
            border: 1px solid black;
            margin: 0px;
        }

        .botonera {
            margin-top: 10px;
        }

        .botonera div {
            max-width: 150px;
            text-align: center;
            padding: auto;
        }

        .botonera div a,
        .botonera div button {
            margin-top: 15px;
            font-weight: 700;
            font-size: large;
            width: 100%;

        }

        .navbar .administrar,
        .navbar .usuarios {
            font-weight: bold;
        }

        .infoPersonal  {
            margin: 10px 0;
        }

        .revisar {
            background-color: coral;
        }
    </style>
    <div class="principal">
        <form action="{{ url('/gUsuario') }}" method="POST" class="container" id="formulario">
            @csrf

            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12">
                    <h2>Información de usuario</h2>
                </div>
            </div>

            <div class="row justify-content-center align-items-center">
                @foreach ($datos as $dato)
                    <div class="container">
                        <div class="tarjeta">
                            <div class="row justify-content-between  align-items-between infoPersonal">
                                <div class="col-12 col-md-3">Número de nómina: <b>{{ $dato->id }}</b></div>
                                <div class="col-12 col-md-3">
                                    <select name="area" id="area" class="form-select"
                                        aria-label="Default select example">
                                        <option value="">Área</option>
                                        <option value="NOMINAS" {{ $dato->area == 'NOMINAS' ? 'selected' : '' }}>NOMINAS
                                        </option>
                                        <option value="RRHH" {{ $dato->area == 'RRHH' ? 'selected' : '' }}>RRHH</option>
                                        <option value="SOPORTE" {{ $dato->area == 'SOPORTE' ? 'selected' : '' }}>SOPORTE
                                        </option>
                                        <option value="DESARROLLO" {{ $dato->area == 'DESARROLLO' ? 'selected' : '' }}>
                                            DESARROLLO</option>
                                        <option value="FINANZAS" {{ $dato->area == 'FINANZAS' ? 'selected' : '' }}>FINANZAS
                                        </option>
                                        <option value="RECLUTAMIENTO"
                                            {{ $dato->area == 'RECLUTAMIENTO' ? 'selected' : '' }}>
                                            RECLUTAMIENTO</option>
                                        <option value="VENTAS" {{ $dato->area == 'VENTAS' ? 'selected' : '' }}>VENTAS
                                        </option>
                                        <option value="MERCADOTECNIA" {{ $dato->area == 'MERCADOTECNIA' ? 'selected' : '' }}>
                                            MERCADOTECNIA
                                        </option>
                                    </select>
                                </div>
                                @php
                                    $admin = $dato->administrador ? 'checked' : '';
                                @endphp
                                <div class="col-12 col-md-2">
                                    <input type="checkbox" class="btn-check col" {{ $admin }} id="administrador"
                                        name="administrador" autocomplete="off" style="display: contents;" value="1">
                                    <label class="btn btn-outline-primary" id='labelTipo' name="admin" for="administrador"
                                        style="min-width: 38px;">Administrador</label><br>
                                </div>
                                <div class="col-12 col-md-3">
                                    @php
                                        $activo = $dato->activo ? 'selected' : '';
                                        $inactivo = !$dato->activo ? 'selected' : '';
                                    @endphp
                                    <select name="activo" id="activo" class="form-select"
                                        aria-label="Default select example">
                                        <option value="1" {{ $activo }}>ACTIVO</option>
                                        <option value="0" {{ $inactivo }}>INACTIVO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-start align-items-start infoPersonal" style="">
                                <div class="col-12 col-md-4">
                                    <!--Nombre: <b>{{ $dato->name . ' ' . $dato->lastName . ' ' . $dato->lastName2 }}</b>-->
                                    <input type="text" name="name" id="name" value="{{ $dato->name }}">

                                </div>
                                <div class="col-6 col-md-4">
                                    <input type="text" name="lastName" id="lastName" value="{{ $dato->lastName }}">
                                </div>
                                <div class="col-6 col-md-4">
                                    <input type="text" name="lastName2" id="lastName2" value="{{ $dato->lastName2 }}">
                                </div>


                            </div>
                        </div>

                        <div class="row justify-content-between align-items-between" style="padding:0;">
                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-6 titulo">
                                    <h2 class=""><b>Extensión</b></h2>
                                </div>
                                <div class="col-5 tarjetainfo">
                                    <input type="text" name="extencion" id="extencion" value="{{ $dato->extencion }}">
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 titulo">
                                    <h2 class=""><b>Laptop</b></h2>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="usr_laptop" id="usr_laptop" value="{{ $dato->area }}">
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="pass_pc" id="pass_pc" value="{{ $dato->pass_pc }}">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center tarjeta">
                            <div class="col-12 titulo">
                                <h2 class=""><b>Correo</b></h2>
                            </div>
                            <div class="col-12 col-md-6 tarjetainfo">
                                <input type="email" name="correo" id="correo" value="{{ $dato->correo }}">
                            </div>
                            <div class="col-12 col-md-6 tarjetainfo">
                                <input type="text" name="pass_correo" id="pass_correo" value="{{ $dato->pass_correo }}">
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center tarjeta">
                            <div class="col-12 titulo">
                                <h2 class=""><b>VPN</b></h2>
                            </div>
                            <div class="col-12 col-md-6 tarjetainfo">
                                <input type="text" name="user_vpn" id="user_vpn" value="{{ $dato->user_vpn }}">
                            </div>
                            <div class="col-12 col-md-6 tarjetainfo">
                                <input type="text" name="pass_vpn" id="pass_vpn" value="{{ $dato->pass_vpn }}">
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center tarjeta">
                            <div class="col-12 titulo">
                                <h2 class=""><b>Servidor</b></h2>
                            </div>
                            <div class="col-12 col-md-6 tarjetainfo">
                                <input type="text" name="user_servidor" id="user_servidor"
                                    value="{{ $dato->user_servidor }}">
                            </div>
                            <div class="col-12 col-md-6 tarjetainfo">
                                <input type="text" name="pass_servidor" id="pass_servidor"
                                    value="{{ $dato->pass_servidor }}">
                            </div>
                        </div>

                        <input type="text" name="id" id="id" value="{{ $dato->id }}" hidden>

                        <div class="row justify-content-between align-items-between botonera">
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-dark btn-lg" id='botonguardar'>
                                    Guardar
                                </button>
                                <button type="submit" class="btn btn-secondary boton d-none btn-lg" id='botonCargando'
                                    disabled>
                                    Cargando . . .
                                </button>
                            </div>
                            <div class="col">
                                <a name="" id="" class="btn btn-danger btn-lg"
                                    href="{{ $datos[0]->id }}/pdf" role="button">PDF</a>
                            </div>

                            <div class="col">
                                <a name="" id="" class="btn btn-block btn-success btn-lg"
                                    href="{{ url()->previous() }}" role="button">Regresar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>

    <script src="{{ asset('js/cargando.js') }}"></script>
    <script src="{{ asset('js/actUsuario.js') }}"></script>
@endsection

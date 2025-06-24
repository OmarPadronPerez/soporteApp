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
            margin: 10px 0;
        }

        .tarjeta {
            box-shadow: 5px 5px 0px 0px black;
            overflow: hidden;
            border-radius: 10px;
            padding: 0px;
            border: 1px solid black;
        }

        .tarjetainfo {
            border: 1px solid black;
            margin: 0px;
        }

        .titulo {
            background-color: #375683;
            color: white;
        }

        .botonera div {
            text-align: center;
            padding: auto;
        }

        .botonera a {

            width: 100px;
            font-weight: bold;
        }

        .tarjeta a {
            text-decoration: none;
            color: black;
        }

        .navbar .directorio {
            font-weight: bold;
        }
    </style>
    <div class="principal">
        <div class="container">
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
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-md-6">Número de nómina: <b>{{ $dato->id }}</b></div>
                                <div class="col-12 col-md-6">Área: <b>{{ $dato->area }}</b></div>
                            </div>

                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-md-6">
                                    Nombre: <b>{{ $dato->name . ' ' . $dato->lastName . ' ' . $dato->lastName2 }}</b>
                                </div>
                                <div class="col-12 col-md-6">
                                    @php
                                        $estado;
                                        if ($dato->activo) {
                                            $estado = 'ACTIVO';
                                        } else {
                                            $estado = 'INACTIVO';
                                        }
                                    @endphp
                                    Estado: <b>{{ $estado }}</b>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between align-items-between" style="padding:0;">
                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 col-md-6 titulo">
                                    <h2 class=""><b>Extensión</b></h2>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="extencion" id="extencion" value="{{ $dato->extencion }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 titulo">
                                    <h2 class=""><b>Laptop</b></h2>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="" id="" value="{{ $dato->area }}"
                                        readonly>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="pass_pc" id="pass_pc" value="{{ $dato->pass_pc }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 titulo">
                                    <h2 class=""><b>Kiosco</b></h2>
                                </div>
                                <a class="col-12 col-md-6 tarjetainfo" target="_blank"
                                    href="http://189.203.75.86/Kioscos/KioscoGrupoABG/index.php">
                                    http://189.203.75.86/Kioscos/KioscoGrupoABG/index.php
                                </a>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="Kiosco" id="pass_Kiosco"
                                        value="Tu RFC en mayúsculas y sin espacios." readonly>
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 titulo">
                                    <h2 class=""><b>Correo</b></h2>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="" id="" value="{{ $dato->correo }}"
                                        readonly>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="pass_correo" id="pass_correo"
                                        value="{{ $dato->pass_correo }}" readonly>
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 titulo">
                                    <h2 class=""><b>VPN</b></h2>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="" id="" value="{{ $dato->user_vpn }}"
                                        readonly>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="pass_vpn" id="pass_vpn" value="{{ $dato->pass_vpn }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center tarjeta">
                                <div class="col-12 titulo">
                                    <h2 class=""><b>Servidor</b></h2>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="" id="" value="{{ $dato->user_servidor }}"
                                        readonly>
                                </div>
                                <div class="col-12 col-md-6 tarjetainfo">
                                    <input type="text" name="pass_servidor" id="pass_servidor"
                                        value="{{ $dato->pass_servidor }}" readonly>
                                </div>
                            </div>

                            <div class="row justify-content-between align-items-between botonera">
                                <div class="col-4 col-md-2">
                                    <a name="" id="" class="btn btn-block btn-success"
                                        href="{{ url()->previous() }}" role="button">Regresar</a>
                                </div>
                                <div class="col-4 col-md-2">
                                    <a name="" id="" class="btn btn-danger"
                                        href="usuarios/{{ $datos[0]->id }}/pdf" role="button">PDF</a>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

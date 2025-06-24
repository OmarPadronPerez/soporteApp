@extends('layout.app')

@section('content')
    <style>
        button {
            margin: 10px 0;
        }

        .datos_drincipal,
        .datos_secundrio {
            border: 0.5px solid black;
            border-radius: 10px;
            margin-bottom: 5px;
            padding: 0.5rem;
        }

        .navbar .administrar {
            font-weight: bold;
        }
    </style>
    @if (!Session::get('administrador'))
        {{ redirect('/nuevo') }}
    @endif

    @php
        $mensaje = session('mensaje');
    @endphp


    <div class="container">
        @if (isset($mensaje))
            <x-mensajes>
                @slot('estado', $mensaje['estado'])
                @slot('titulo', $mensaje['titulo'])
                @slot('mensaje', $mensaje['mensaje'])
            </x-mensajes>
        @endif
        <div class="row justify-content-center align-items-center g-2 ">

            <div class="col">
                <h2>Nuevo usuario</h2>
            </div>

            <form action="{{ url('/nuevoUsuario/nsStorage') }}" method="POST" style="margin: 20px">
                @csrf
                <div class="datos_drincipal ">
                    <div class="row g-2 justify-content-center align-items-center ">
                        <div class="mb-3 col-12 col-md-4">
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" placeholder="Nombre(s)" value="{{ old('name') }}" required />
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <input type="text" class="form-control" name="lastName" id="lastName"
                                aria-describedby="helpId" placeholder="Apellido Paterno" value="{{ old('lastName') }}"
                                required />
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <input type="text" class="form-control" name="lastName2" id="lastName2"
                                aria-describedby="helpId" placeholder="Apellido Materno" value="{{ old('lastName2') }}"
                                required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col-12 col-md-4">
                            <select name="area" id="area" class="form-select" aria-label="Default select example"
                                required value="{{ old('area') }}">
                                <option value="">Área</option>
                                <option value="NOMINAS">NOMINAS</option>
                                <option value="RRHH">RRHH</option>
                                <option value="SOPORTE">SOPORTE</option>
                                <option value="DESARROLLO">DESARROLLO</option>
                                <option value="FINANZAS">FINANZAS</option>
                                <option value="RECLUTAMIENTO">RECLUTAMIENTO</option>
                                <option value="VENTAS">VENTAS</option>
                                <option value="MERCADOTECNIA">MERCADOTECNIA</option>
                            </select>
                        </div>

                        <div class=" col-12 col-md-4">
                            <input type="number" class="form-control" name="id" id="id"
                                aria-describedby="helpId" placeholder="Numero de nomina" value="{{ old('id') }}"
                                required />
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="checkbox" class="btn-check col" id="administrador" value="1"
                                name="administrador" autocomplete="off">
                            <label class="btn btn-outline-primary" for="administrador">Administrador</label><br>
                        </div>
                    </div>
                </div>

                <div class="datos_secundrio">
                    <div class="row g-2 justify-content-between align-items-between">
                        <div class="mb-3 col-6 col-md-2 ">
                            <button class="btn btn-danger btn-lg" type="button" id="btnRellenar">Rellenar</button>
                        </div>
                        <div class="mb-3 col-6 col-md-2" style="text-align: end">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg" type="submit"
                                id="btnGuardar" disabled>Guardar</button>
                        </div>
                    </div>
                    <div class="row g-2 ">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="pass_pc" class="form-label">Contraseña de PC/Laptop</label>
                            <input type="text" class="form-control" name="pass_pc" id="pass_pc"
                                aria-describedby="helpId" value="{{ old('pass_pc') }}" placeholder="" />
                        </div>
                        <!--desactivado
                                    <div class="mb-3 col-12 col-md-6 d-none">
                                        <label for="pass_aps" class="form-label">Contraseña Aplicaciones</label>
                                        <input type="text" class="form-control" name="pass_aps" id="pass_aps"
                                            aria-describedby="helpId" placeholder="" disabled/>
                                    </div>-->
                        <div class="mb-3 col-12 col-md-6">
                            <label for="extencion" class="form-label">Extensión telefónica</label>
                            <input type="number" class="form-control" name="extencion" id="extencion"
                                aria-describedby="helpId" placeholder="" value="{{ old('extencion') }}" />
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="correo" id="correo"
                                aria-describedby="helpId" placeholder="&#64;grupoabg" value="{{ old('correo') }}"
                                required />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="pass_correo" class="form-label">Contraseña del correo</label>
                            <input type="text" class="form-control" name="pass_correo" id="pass_correo"
                                aria-describedby="helpId" placeholder="" value="{{ old('pass_correo') }}" required />
                        </div>
                    </div>

                    <div class="row g-2 ">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="user_vpn" class="form-label">Usuario VPN</label>
                            <input type="text" class="form-control" name="user_vpn" id="user_vpn"
                                aria-describedby="helpId" placeholder="Usuario" value="{{ old('user_vpn') }}"
                                required />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="pass_vpn" class="form-label">Contraseña VPN</label>
                            <input type="text" class="form-control" name="pass_vpn" id="pass_vpn"
                                aria-describedby="helpId" placeholder="" value="{{ old('pass_vpn') }}" required />
                        </div>
                    </div>

                    <div class="row g-2 ">
                        <div class="col-12 col-md-6">
                            <label for="user_servidor" class="form-label">Usuario del servidor</label>
                            <input type="text" class="form-control" name="user_servidor" id="user_servidor"
                                aria-describedby="helpId" placeholder="" value="{{ old('user_servidor') }}" required />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="pass_servidor" class="form-label">Contraseña del servidor</label>
                            <input type="text" class="form-control" name="pass_servidor" id="pass_servidor"
                                aria-describedby="helpId" placeholder="" value="{{ old('pass_servidor') }}" required />
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="{{ asset('js/AgregarUsuario.js') }}"></script>
@endsection

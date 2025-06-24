@extends('layout.app')

@section('content')
    <style>
        .container h2 {
            text-align: left;
        }

        .container h2,
        .container h3 {
            margin: auto;
        }

        .container {
            margin-top: 10px;
        }

        .formorden {
            margin-left: 10px;
            width: 50%;
        }

        .divOrden {
            display: flex;
            justify-content: flex-end;
        }
        nav .directorio {
            font-weight: bold;
        }
        @media screen and (max-width: 800px) {
            .container h2 {
                text-align: center;
            }

            .divOrden {
                justify-content: left;
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-between align-items-between g-2" style="margin: 10px 0px">
            <div class="col-12 col-lg-3">
                <h2>Usuarios</h2>
            </div>
            @if (Session::get('administrador'))
                <div class="col-12 col-md-3 col-lg-1" style="text-align:center;">
                    <a name="" id="" class="btn btn-primary" href="./nuevoUsuario" role="button">Nuevo</a>
                </div>
            @endif


            <div class="col-12 col-md-9 col-lg-5 divOrden" style="">
                <h3>Ordenar por </h3>
                <form class="formorden" id="formorden" method="GET" action="{{ route('usuarios') }}">
                    <select class="form-select form-select-lg " name="orden" id="orden" style=""
                        onchange="this.form.submit()">
                        <option value="name" {{ request('orden') == 'name' ? 'selected' : '' }}>Nombre
                        </option>
                        <option value="area" {{ request('orden') == 'area' ? 'selected' : '' }}>Area</option>
                        <option value="id" {{ request('orden') == 'id' ? 'selected' : '' }}>ID</option>
                    </select>
                </form>
            </div>

        </div>
        <hr>

        <div class="row justify-content-center align-items-center">

            @foreach ($datos as $dato)
                @if (!($dato->id == '1'))
                    @php
                        $nombreCompleto = $dato->name . ' ' . $dato->lastName . ' ' . $dato->lastName2;
                    @endphp

                    <x-tarjetaUsuario>
                        @slot('id', $dato->id)
                        @slot('name', $nombreCompleto)
                        @slot('activo', $dato->activo)
                        @slot('correo', $dato->correo)
                        @slot('administrador', $dato->administrador)
                        @slot('extencion', $dato->extencion)
                        @slot('area', $dato->area)
                        @slot('updated_at', $dato->updated_at)
                    </x-tarjetaUsuario>
                @endif
            @endforeach

        </div>
        {{ $datos->links('pagination::bootstrap-5') }}
    </div>
@endsection

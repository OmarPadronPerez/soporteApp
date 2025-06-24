@extends('layout.app')

@section('content')
{{$dato}}
    <div class="row justify-content-center align-items-center g-2">

        <div class="card ">
            <div class="card-header">

                <h4><b>Usuario: </b>{{ $dato->User }}</h4>

                <h5><b>Falla con: </b>{{ $dato->Falla }}</h5>
                <div class="mb-3">
                    <label for="" class="form-label ">
                        <h5>Prioridad:</h5>
                    </label>
                </div>

            </div>
            <div class="card-header">
                <h4><b>Fecha de creación: </b> {{ $dato->created_at }}</h4>
            </div>
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
            <div class="col-12 col-md-5 imagen">
                <img src="image source" class="img-fluid rounded-top" alt="" />

            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="" class="form-label">
                    <h3>Diagnóstico técnico</h3>
                </label>
                <textarea class="form-control" name="Diagnostico" id="Diagnostico" rows="3">@if ($dato->Diagnostico){{$dato->Diagnostico}}@endif
                </textarea>
            </div>
        </div>
        <div class="row justify-content-between align-items-start g-2">
            <h3>Estado</h3>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check " value="En revisión" name="Estado" id="btncheck1"
                    autocomplete="off" />
                <label class="btn btn-outline-primary " for="btncheck1">En revisión</label>

                <input type="radio" class="btn-check" value="Concluido" name="Estado" id="btncheck3"
                    autocomplete="off" />
                <label class="btn btn-outline-primary" for="btncheck3">Concluido</label>
            </div>
        </div>
        <textarea class="form-control d-none" name="id" id="id" rows="1">{{ $datos[0]->id }}</textarea>
        <div class="espacio" style="height: 20px"></div>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
        <div class="espacio" style="height: 20px"></div>

    </div>
@endsection

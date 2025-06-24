<div class="card ">
    <div class="card-header">
        <h4><b>Usuario: </b>{{ $Usuario }}</h4>

        <h5><b>Falla con: </b>{{ $Falla }}</h5>
        <div class="mb-3">
            <label for="" class="form-label ">
                <h5>Prioridad</h5>
            </label>
            <select class="form-select form-select-lg " name="" id="">
                <option value="Normal" selected>Normal</option>
                <option value="Baja">Baja</option>
                <option value="Alta">Alta</option>
                <option value="Critica">Crítica</option>
            </select>
        </div>
    </div>
    <div class="card-header">
        <h4><b>Fecha de creación: </b> {{$FCreacion}}</h4>
        @if($FCreacion)
        <h4><b>Fecha de resolución: </b> {{$FCreacion}}</h4>
        @endif
    </div>
    <div class="card-body">
        <div class="descripcion">
            <h4 class="card-title">Descripción del problema</h4>
            <p class="card-text">
                @if ($Descripcion)
                    {{ $Descripcion }}
                @endif
            </p>
        </div>
    </div>
    <div class="col-12 col-md-5 imagen">
        <img src="image source" class="img-fluid rounded-top" alt="" />
    </div>
</div>

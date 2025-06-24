@php
    $imageUrl = public_path('/imagenes/logoABG.png');
    $message->embed($imageUrl, 'Grupo ABG');
@endphp



<div>
    <img src={{ $message->embed($imageUrl) }} style="width:auto;" alt="Grupo ABG" srcset="">
</div>

<h2>Se realizo un ticket de mantenimiento nuevo</h2>

ID de ticket: <b>{{ $datos->id }}</b>
<br>
Usuario: <b>{{  $datos->creador_name . ' ' . $datos->creador_lastName }}</b>
<br>
Fecha: <b>{{ $datos->created_at }}</b>
<br>
Falla: <b>{{ $datos->Falla }}</b>
<br>
Descripcion de falla
<br>
@if ($datos->Falla != 'TIMBRADO ')
    @if (isset($datos->Detalles))
        <b>{{ $datos->Detalles }}</b>
    @endif

@endif

<h3>Nos comunicaremos lo mas rapido posible</h3>
<h4>Area de Sistemas de Grupo ABG</h4>

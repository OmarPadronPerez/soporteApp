@php
    $imageUrl = public_path("/imagenes/logoABG.png");
    $message->embed($imageUrl, 'Grupo ABG');
@endphp

<div>
    <img src={{$message->embed($imageUrl)}} style="width:auto;" alt="Grupo ABG" srcset="">
</div>
<h2>Ticket de mantenimiento cerrado</h2>

ID de ticket: <b>{{ $datos->id }}</b>
<br>
Usuario: <b>{{$datos->creador_name." ".$datos->creador_lastName}}</b>
<br>
Fecha de reporte: <b>{{ $datos->created_at }}</b>
<br>
Fecha de cierre: <b>{{$datos->fecha_resuelto}}</b>
<br>
Falla: <b>{{$datos->Falla}}</b>
<br>
Descripción de la falla:
<br>
<b>{{$datos->Detalles}}</b>
<br>
Resuelto por: <b>{{$datos->resuelto_name.' '.$datos->resuelto_lastName}}</b>
<br>
Comentarios: 
<br>
<b>{{$datos->Diagnostico}}</b>

<h3>Gracias por tu paciencia. Estamos para servirte.</h3>
<h4>Área de Sistemas de Grupo ABG</h4>


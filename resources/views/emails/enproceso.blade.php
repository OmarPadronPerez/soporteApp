@php
    $imageUrl = public_path('/imagenes/logoABG.png');
    $message->embed($imageUrl, 'Grupo ABG');
@endphp

<div>
    <img src={{ $message->embed($imageUrl) }} style="width:auto;" alt="Grupo ABG" srcset="">
</div>

<h2>Estamos trabajando</h2>

<p>Ya estamos trabajando. En unos momentos nos comunicaremos contigo.</p>
<p>Si es necesario entrar a tu sesión, guarda todo tu trabajo. Te avisaremos cuando hayamos terminado y podrás ingresar
    de nuevo.</p>
<br>
<br>
ID de ticket: <b>{{ $datos->id }}</b>
<br>
Usuario: <b>{{ $datos->creador_lastName . ' ' . $datos->creador_name }}</b>
<br>
Fecha: <b>{{ $datos->created_at }}</b>
<br>
Falla: <b>{{ $datos->Falla }}</b>
<br>
Descripción de la falla:
<br>
@if (isset($datos->Detalles))
    <b>{{ $datos->Detalles }}</b>
@endif

<p>Gracias por tu paciencia.</p>
<p>Cualquier duda o sugerencia sobre nuestro servicio, puedes contactarnos en las extensiones <b>138 o 140</b>.</p>
<h4>Área de Sistemas de Grupo ABG</h4>

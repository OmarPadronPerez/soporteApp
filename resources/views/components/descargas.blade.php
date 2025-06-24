<style>
    .vista img {
        border: 1px solid #000000;
        padding: 2px;
        width: 100%
    }


    .botonD {
        margin-bottom: 5px;
        margin-left: 5px;
    }

    iframe {
        height: 400px;
        width: 100%;
    }
</style>
@php
    $previa = 'display: none';
    $estilo = 'btn-warning';
    $ruta = 'storage/archivos/' . $id . '/' . $file;
    $extencion = Str::afterLast($file, '.');
    $tipo = '';
    switch ($extencion) {
        case 'pdf':
            $tipo = 'PDF';
            $estilo = 'btn-danger';
            $previa = '';
            break;

        case 'PNG':
        case 'png':
        case 'jpg':
        case 'jpeg':
            $tipo = 'Imagen';
            $estilo = 'btn-primary';
            $previa = '';
            break;

        case 'xml':
            $tipo = 'XML';
            $estilo = 'btn-secondary';
            break;

        case 'xlsx':
        case 'xls':
            $tipo = 'Excel';
            $estilo = 'btn-success';
            break;

        default:
            $tipo = $extencion;
            break;
    }
@endphp



<h3>Archivos</h3>
<div class="vista" style="{{ $previa }}">
    @if ($tipo == 'Imagen')
        <!--si es imagen-->
        <img src="{{ asset($ruta) }}" class="img-fluid rounded-top" alt="" />
    @endif
    @if ($tipo == 'PDF')
        <!--si es pfd-->
        <!--<iframe src="{{ asset($ruta) }}" type="application/pdf" frameborder="0"></iframe>-->

        <iframe src="https://docs.google.com/gview?url={{ asset($ruta) }}&embedded=true" width="100%"
            height="600px"></iframe>

    @endif
</div>
<div class="mb-1">
    <a name="" id="" style="margin-top: 15px;" class="btn {{ $estilo }} botonD"
        href="/tickets/{{ $id }}/{{ $file }}" role="button">Descargar <b>{{ $tipo }}</b>
    </a>
</div>

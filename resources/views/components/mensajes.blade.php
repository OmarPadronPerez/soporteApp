<?php
$estilo = '';

switch ($estado) {
    case 'realizado':
        $estilo = 'alert-success';
        break;
    case 'falla':
        $estilo = 'alert-danger';
        break;
}
?>
<style>
</style>

<div class="container mensaje" style="margin-top:10px">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col alert  {{ $estilo }} alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div>
                <h3>{{ $titulo }}</h3>
                {{ $mensaje }}
            </div>
        </div>
    </div>
</div>

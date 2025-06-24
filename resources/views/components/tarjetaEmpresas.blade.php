<style>
    a {
        min-width: 100px;
        text-decoration: none;
        color: black;
        
    }

    h2 {
        font-size: 2em;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tarjeta {
        margin: 20px;
        box-shadow: 5px 5px 0px 0px black;
        overflow: hidden;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid black;
    }

    .titulo {
        height: auto;
    }

    .desactivado {
        background-color: #aeafb4;
    }

    .btn-outline-light {
        color: #000;
    }

    .boton {
        margin: 5px;
    }
</style>

<a class="tarjeta text-center justify-content-center align-items-center row  {{ $activo != 1 ? 'desactivado' : '' }}"
href="./empresas/{{ $id }}">
    <div class="titulo col-12 col-md-9">
        <h2>{{ $empresa }}</h2>
    </div>
    

    <!--<div class=" col-12 col-md-2 boton">
        <a name="" id="" type="button"
            class="btn {{ $activo != 1 ? 'btn-outline-light' : '"btn btn-outline-secondary' }}"
            href="/empresas/{{ $id }}/estado"
            role="button">
            {{ $activo == 1 ? 'Desactivar' : 'Activar' }}
        </a>
    </div>-->

</a>

console.log('en reportes');

const fInicio = document.getElementById('fecha_inicio');
const fFin = document.getElementById('fecha_fin');
const btnBuscar = document.getElementById('btnBuscar');

fInicio.addEventListener('change',calcularFechas);
fFin.addEventListener('change',calcularFechas);

calcularFechas()

function calcularFechas() {
    let fecha_inicio = new Date(fInicio.value);
    let fecha_fin = new Date(fFin.value);
    let diferencia = fecha_fin.getTime() - fecha_inicio.getTime();

    if (diferencia >= 0) {
        cambiarCampos(1)
    } else {
        cambiarCampos(0)
    }
}

function cambiarCampos(estado){
    if(estado==0){
        fInicio.classList.add("no_permitido");
        fFin.classList.add("no_permitido");
        btnBuscar.classList.add("disabled");
    }
    else{
        fInicio.classList.remove("no_permitido");
        fFin.classList.remove("no_permitido");
        btnBuscar.classList.remove("disabled");
    }
}


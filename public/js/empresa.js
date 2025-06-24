console.log('en empresa.js');

const divestado=document.getElementById('estado');
const divestadoLavel=document.getElementById('estadoLavel');
const divactivo=document.getElementById('activo');

divestado.addEventListener('click',cambiodeEstado);

function cambiodeEstado(){
    let estado=divactivo.checked;
    console.log('cambiodeEstado:'+estado);
    

    if(estado){
        divestadoLavel.classList.add('inactivo');
        divestadoLavel.innerHTML='Inactivo';

    }
    else{
        divestadoLavel.classList.remove('inactivo');
        divestadoLavel.innerHTML='Activo';
    }
    divactivo.checked = !divactivo.checked;
}




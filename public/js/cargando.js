console.log('cargando')
const formulario = document.getElementById('formulario');
const btn_botonguardar = document.getElementById('botonguardar');
const botonCargando = document.getElementById('botonCargando');

formulario.addEventListener('submit', cargando);

inicio();

function cargando() {
    console.log('cargando...');
    btn_botonguardar.classList.add('d-none');
    botonCargando.classList.remove('d-none');
}
function inicio(){
    console.log('original...');
    btn_botonguardar.classList.remove('d-none');
    botonCargando.classList.add('d-none');
}
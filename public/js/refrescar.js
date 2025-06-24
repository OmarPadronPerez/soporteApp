var refrescar;
var bPreguntar = true;

recargar();
window.onbeforeunload = Salir;

function recargar() {
    refrescar = setInterval(function () {
        location.reload();
    }, 60000);
}
function parar() {
    clearInterval(refrescar);
}

function Salir() {
    if (bPreguntar){
        parar();
        //return "¿Seguro que quieres salir?";
    }
}
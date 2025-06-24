console.log('en Nueva Empresa');

const inputEmpresa = document.getElementById('nombre');
const inputUsuario = document.getElementById('usuario');
const inputContrasena = document.getElementById('contrasena');
const inputBase = document.getElementById('base_de_datos');

inputEmpresa.addEventListener('keyup', rellenar);
inputEmpresa.addEventListener('blur', quitarespacios);

function rellenar(){
    let empresa=limpiarCadena(inputEmpresa.value);

    inputUsuario.value=empresa.toUpperCase();
    inputContrasena.value='abg'+empresa;
    inputBase.value=empresa;
}

function quitarespacios(){
    let empresa=inputEmpresa.value;
    empresa=empresa.trim().toUpperCase();
    inputEmpresa.value=empresa;
}

function limpiarCadena(cadena){
    cadena=cadena.trim();
    cadena=cadena.toLowerCase();
    return cadena.replace(/\s+/g, "_");
}
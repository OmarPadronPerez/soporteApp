console.log('en actUsuario');

const boton = document.getElementById('labelTipo');
//campos de nombre
const inpName = document.getElementById('name');
const inplastName = document.getElementById('lastName');
const inplastName2 = document.getElementById('lastName2');
//otros campos
const pass_pc = document.getElementById('pass_pc');
const correo = document.getElementById('correo');
const pass_correo = document.getElementById('pass_correo');
const user_vpn = document.getElementById('user_vpn');
const pass_vpn = document.getElementById('pass_vpn');
const user_servidor = document.getElementById('user_servidor');
const pass_servidor = document.getElementById('pass_servidor');

//eventos
pass_pc.addEventListener('keyup',revisarCampos);
correo.addEventListener('keyup',revisarCampos);
pass_correo.addEventListener('keyup',revisarCampos);
user_vpn.addEventListener('keyup',revisarCampos);
pass_vpn.addEventListener('keyup',revisarCampos);
user_servidor.addEventListener('keyup',revisarCampos);
pass_servidor.addEventListener('keyup',revisarCampos);

boton.addEventListener('click', cambiarTipo);
formulario.addEventListener('submit', cambiarnombres);
revisarCampos();

//funciones
function cambiarnombres() {
    inpName.value = corregirNombre(inpName.value);
    inplastName.value = corregirNombre(inplastName.value);
    inplastName2.value = corregirNombre(inplastName2.value);
}

function corregirNombre(str) {
    let cadena = quitarEspacios(str);
    cadena = mayusculas(cadena);
    return cadena;
}

//funcion para cambiar la etiqueta de administrador o usuario
function cambiarTipo() {
    var estado = 0;

    if (estado == 0) {
        boton.innerHTML = 'Administrador';
        estado = 1;
    } else {
        boton.innerHTML = 'Usuario';
        estado = 0;
    }
}

function quitarAcentos(str) {
    try {
        str = String(str);
        let cadena = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        return cadena
    } catch (error) {
        console.log('error ' + error);
        return str
    }
}
function quitarEspacios(str) {
    return str.trim();
}

function minusculas(str) {
    return str.toLowerCase();
}
function mayusculas(str) {
    return str.toUpperCase();
}

function revisarCampos() {
    let pasa = true;
    if (pass_pc.value.length < 3) {
        pasa = false;
        pass_pc.classList.add('revisar');
    }else{
        pass_pc.classList.remove('revisar');
    }
    if (correo.value.length < 3) {
        pasa = false;
        correo.classList.add('revisar');
    }else{
        correo.classList.remove('revisar');
    }
    if (pass_correo.value.length < 3) {
        pasa = false;
        pass_correo.classList.add('revisar');
    }else{
        pass_correo.classList.remove('revisar');
    }
    if (user_vpn.value.length < 3) {
        pasa = false;
        user_vpn.classList.add('revisar');
    }else{
        user_vpn.classList.remove('revisar');
    }
    if (pass_vpn.value.length < 3) {
        pasa = false;
        pass_vpn.classList.add('revisar');
    }else{
        pass_vpn.classList.remove('revisar');
    }
    if (user_servidor.value.length < 3) {
        pasa = false;
        user_servidor.classList.add('revisar');
    }else{
        user_servidor.classList.remove('revisar');
    }
    if (pass_servidor.value.length < 3) {
        pasa = false;
        pass_servidor.classList.add('revisar');
    }else{
        pass_servidor.classList.remove('revisar');
    }
    botonguardar(pasa);
    return pasa;
}

function botonguardar(estado){
    if(estado){
        btn_botonguardar. disabled = false;
    }else{
        btn_botonguardar. disabled = true;
    }
}
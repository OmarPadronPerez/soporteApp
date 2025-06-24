console.log("en agregar Usuario js");
//entradas principales
const inName = document.getElementById('name');
const inLast_name = document.getElementById('lastName');
const inLast_name2 = document.getElementById('lastName2');
const inId = document.getElementById('id');
const inArea = document.getElementById('area');

//entradas a calcular
const inName_user = document.getElementById('user_vpn');
const inVpn = document.getElementById('pass_vpn');
const inCorreo = document.getElementById('correo');
const inpassCorreo = document.getElementById('pass_correo');
const inUserServidor = document.getElementById('user_servidor');
const inPassServidor = document.getElementById('pass_servidor');
const inLaptop = document.getElementById('pass_pc');

const btnRellenar=document.getElementById('btnRellenar');
const btnGuardar = document.getElementById('btnGuardar');

//eventos de principal
btnRellenar.addEventListener("click", (e) => { crearContra(e) });

inName.addEventListener("keyup", (e) => { botonGuardar(e) });
inLast_name.addEventListener("keyup", (e) => { botonGuardar(e) });
inLast_name2.addEventListener("keyup", (e) => { botonGuardar(e) });
inId.addEventListener("keyup", (e) => { botonGuardar(e) });
inArea.addEventListener("change", (e) => { botonGuardar(e) });
inName_user.addEventListener("keyup", (e) => { botonGuardar(e) });
inVpn.addEventListener("keyup", (e) => { botonGuardar(e) });
inCorreo.addEventListener("keyup", (e) => { botonGuardar(e) });
inpassCorreo.addEventListener("keyup", (e) => { botonGuardar(e) });
inUserServidor.addEventListener("keyup", (e) => { botonGuardar(e) });
inPassServidor.addEventListener("keyup", (e) => { botonGuardar(e) });
inLaptop.addEventListener("keyup", (e) => { botonGuardar(e) });

function crearContra(e) {
    if (inName.value.length > 1
        && inLast_name.value.length > 1
        && inId.value.length > 1
        && inArea.value.length > 1
    ) {
        var nombre = inName.value;
        var apellido = inLast_name.value;
        var apellido2 = inLast_name2.value
        var nomina = inId.value;

        //se valua si tiene 2 o mas palabras en el nombre y apellido
        var nombreArray = nombre.split(" ");
        var apellidoArray = apellido.split(" ");
        nombre = escojerNombre(nombreArray);
        nombre=quitarAcentos(nombre);
        //si tiene varias palabras en el apellido toma la palabra mas grande
        apellido = pegarNombres(apellido);
        apellido=quitarAcentos(apellido);

        //se extraen las iniciales del nombre y apellido
        var inicialNombre = mayusculas(nombre.substring(0, 1));
        var inicialApellido = mayusculas(apellido.substring(0, 1));

        //se calcula el numero de nomina y la contraseña del serviordependiendo del area 
        var passServidor = '';
        switch (inArea.value) {
            case "SOPORTE":
                nomina = '0' + nomina;
                passServidor = "ADM_";
                break;

            case 'FINANZAS':
                nomina = '1' + nomina;
                passServidor = "FIN_";
                break;

            case "NOMINAS":
                nomina = '2' + nomina;
                passServidor = "NOM_";
                break;

            case "SELECCION":
                nomina = '3' + nomina;
                passServidor = "SEL_";
                break;

            case "DESARROLLO":
                nomina = '4' + nomina;
                passServidor = "SIS_";
                break;

            case 'VENTAS':
                nomina = '5' + nomina;
                passServidor = "VEN_";
                break;

            case "RRHH":
                nomina = '6' + nomina;
                passServidor = "RRHH_";
                break;

            case 'default':
                nomina = '9' + nomina;
                passServidor = "OTR_";
                break;
        }
        //se calcula el usuario de sus seciones 
        var usuario = inicialNombre + apellido;
        passServidor = passServidor + nomina + "_" + inicialNombre + inicialApellido;

        //se calcula el correo y contrasena
        var correo = nombre + "." + apellido + "@grupoabg.com";
        var passCorreo = "Mail_" + nomina + '_' + inicialNombre + inicialApellido;

        //se calcula las credenciales de la PVN
        var usrVPN = usuario;
        var passVPN = 'VPN_' + nomina + '_' + inicialNombre + inicialApellido;

        //se calcula la contraseña de la laptop
        var passLaptop = 'ABG_54321_' + inicialNombre + inicialApellido;

        //se setean las cadenas en los espacios
        inCorreo.value = correo.toLowerCase();
        inpassCorreo.value = passCorreo;
        inLaptop.value = passLaptop;
        inName_user.value = usuario.toLowerCase();//usuario de vpn
        inVpn.value = passVPN;
        inPassServidor.value = passServidor;
        inUserServidor.value = usuario.toLowerCase();

        //reincerta los nombres limpios 
        inName.value = prepararNombre(inName.value);
        inLast_name.value = prepararNombre(inLast_name.value);
        inLast_name2.value = prepararNombre(inLast_name2.value);
    }
    botonGuardar();
}

function escojerNombre(lista) {
    let cadena = '';
    //escoje el nombre mas largo y lo asigna
    /*for (let i = 0; i < lista.length; i++) {
        let evaluar = prerparaCadenas(lista[i]);
        if (evaluar != null || evaluar.length > 1) {
            if (cadena.length < evaluar.length) {
                cadena = evaluar;
            }
        }
    }*/
    //se asigna el primer nombre
    cadena=lista[0];
    console.log(cadena)
    return cadena;
}

function quitarAcentos(str) {
    try {
        str=String(str);
        let cadena = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        console.log('quitarAcentos '+cadena);
        return cadena
    } catch (error) {
        console.log('error '+error);
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

function prerparaCadenas(str) {
    try {
        let cadena = quitarEspacios(str);
        cadena = quitarAcentos(cadena);
        cadena = minusculas(cadena);
        return cadena
    } catch (error) {
        console.log(str);
        console.log(error);
    }
}
function prepararNombre(str) {
    try {
        let nombre = '';
        nombre = quitarEspacios(str);
        nombre = mayusculas(nombre);
        return nombre;
    } catch (error) {
        console.log(str)
        console.log(error)
    }

}
function pegarNombres(str){
    return str.replace(/\s/g, "")
}

function botonGuardar() {
    if (inName.value.length > 0
        && inLast_name.value.length > 0
        && inId.value.length > 0
        //&& inArea.value
        && inLaptop.value.length > 0
        && inCorreo.value.length > 0
        && inpassCorreo.value.length > 0
        && inName_user.value.length > 0
        && inVpn.value.length > 0
        && inUserServidor.value.length > 0
        && inPassServidor.value.length > 0
    ) {
        if(inArea.value!=''){
            btnGuardar.disabled = false;
        }else{
            btnGuardar.disabled = true;
        }
        
    } else {
        btnGuardar.disabled = true;
    }
}

console.log("crearticket.js");
// Variables document
const select1 = document.getElementById("Falla1");

const select2 = document.getElementById('Falla2');
const campo3 = document.getElementById('campo3');
const btnResolver = document.getElementById('btn_resolver');

const divDetalles = document.getElementById('enviar');
const btnSalir = document.getElementById('btnSalir');
const txt_detalles = document.getElementById('detalles');

const cbEmpleados = document.getElementById('cb_empleados_todos');
const formEmpleados = document.getElementById('formEmpleados');
const divtimbrado = document.getElementById('divTimbrado');
const btn_confirmar = document.getElementById('btn_confirmar');
const btn_modificar = document.getElementById('btn_modificar');
const btn_botonguardar = document.getElementById('botonguardar');
const botonCargando = document.getElementById('botonCargando');
const formulario = document.getElementById('formulario');

const in_empresa = document.getElementById('Empresa');
const in_Ejercicio = document.getElementById('Ejercicio');
const in_empleados = document.getElementById('in_Empleados');
const in_Periodo = document.getElementById('Periodo');
const btn_timbrado = document.getElementById('Timbrado');
const btn_Cancelación = document.getElementById('Cancelación');
const tipo_cancelado = document.getElementById('tipo_cancelado');


//variables glovales
var administrador = 0;
var timeoutId;

//eventos
select1.addEventListener('change', campo2);
//select2.addEventListener('change', reset)
cbEmpleados.addEventListener('change', function () {
    if (cbEmpleados.checked) {
        formEmpleados.classList.add("d-none");

    } else {
        formEmpleados.classList.remove("d-none");
    }
});
select2.addEventListener('change', campo2Conexion);
btn_Cancelación.addEventListener('click', tipocancelado);
formulario.addEventListener('submit', cargando);

function limpiar(select) {
    do {
        select.remove(0);
    } while (select.length > 0)
}

function campo2() {
    reset();

    if (select2.length > 0) {
        limpiar(select2);
        campo3.classList.add("d-none");
    }
    switch (select1.value) {
        case 'Conexion':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('No me puedo conectar a la VPN', 'VPN'));
            select2.appendChild(new Option('No tengo internet', 'Internet'));
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;

        case 'PC':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('Mi equipo no enciende', 'No_enciende'));
            select2.appendChild(new Option('Mi equipo enciende pero tiene pantalla azul', 'pantalla_azul'));
            select2.appendChild(new Option('Se traba mucho / Esta muy lenta', 'se_traba'));
            select2.appendChild(new Option('Solicitar mantenimiento', 'mantenimiento'));
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;


        case 'Accesorios':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('Mi mouse no funciona bien', 'mouse'));
            select2.appendChild(new Option('Mi teclado no funciona bien', 'teclado'));
            select2.appendChild(new Option('Mi adaptador de red usb', 'adaptador_red'));
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;
        case 'Correo':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('No puedo enviar correos', 'enviar_correo'));
            select2.appendChild(new Option('No puedo recibir correos', 'recibir_correo'));
            select2.appendChild(new Option('Necesito activar la respuesta automatica', 'respuesta_automatica'));
            select2.appendChild(new Option('¿Como puedo agregar mi correo a mi smartphone/iphone?', 'conectar_correo'));
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;

        case 'Aplicaciones':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('Kiosko', 'app_kiosko'));
            select2.appendChild(new Option('Sitio de recibos', 'app_recibos'));
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;

        case 'Office':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('Se traba', 'oficce_se_traba'));
            select2.classList.remove("d-none");
            break;

        case 'Servidor':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('Mi sesión esta lenta', 'sesión_lenta'));
            select2.appendChild(new Option('No entra a mi sesión', 'sesión_contreseña'));
            select2.appendChild(new Option('No me puedo conectar al servidor', 'servidor_no_responde'));
            if (administrador == 1) {
                select2.appendChild(new Option('Mantenimiento de servidor', 'Mantenimiento'));
            }
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;

        case 'Timbrado':
            select2.appendChild(new Option('ESCOJA UNA OPCION', ''));
            select2.appendChild(new Option('Timbrado / cancelacion', 'Timbrado/cancelacion'));
            select2.appendChild(new Option('Consulta', 'Consulta_Timbrado'));
            select2.appendChild(new Option('Otra cosa', 'Otra_cosa'));
            select2.classList.remove("d-none");
            break;

        case 'Otra_cosa':
            reset();
            limpiar(select2);
            campo3.innerHTML = '<h3>¿Necesitas ayuda con algo más?</h3><ul><li><b>Lee las opciones que te damos</b>, puede que alguna de esas arregle tu problema sin tener que esperar.</li><li>También puedes llamarnos a las <b>extensiones 138 y 140</b>, con gusto te atenderemos.</li></ul>';
            campo3.classList.remove("d-none");
            mostrar_enviar(1);
            break;

        default:
            select2.classList.add("d-none");
            btn_botonguardar.classList.add("d-none");
            campo3.classList.add("d-none");
            break;
    }

}

function setAdministrador(tipo) {
    this.administrador = tipo;
}

function campo2Conexion() {
    reset();
    campo3.innerHTML = '';
    clearTimeout(timeoutId);

    switch (select2.value) {
        case 'VPN':
            campo3.innerHTML = '<h3>¿Qué hago si no me conecta a la VPN?</h3><ul><li>Revisa que tu equipo esté <b>conectado a internet</b>. Puedes abrir algunas páginas o un video de YouTube para verificar tu conexión.</li><li>Revisa que tu equipo tenga una <b>conexión estable</b>. Conéctate por cable si tienes la posibilidad.</li><li><b>Revisa tu usuario y contraseña</b>, los puedes consultar en el apartado de "Mi información".</li><li>Revisa la velocidad de tu internet. Puedes hacerlo en la página de <a target="_blank" href="https://www.speedtest.net/es">Speedtest</a>.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'Internet':
            campo3.innerHTML = '<h3>¿No tienes internet en tu equipo?</h3><ul><li>Revisa si tu equipo está <b>conectado a la red</b>.</li><li>Posiblemente funcione <b>desconectar tu equipo de la red y volverlo a conectar</b>.</li><li>Revisa que tengas <b>internet en otros dispositivos</b>.</li><li><b>Checa la velocidad de tu internet</b>. Puedes hacerlo en la página de <a target="_blank" href="https://www.speedtest.net/es">Speedtest</a>. Una velocidad muy baja, <b>menor de 1mb</b>, te dará la sensación de que no tienes internet.</li><li>Revisa tu módem u ONT. La mayoría de ellos tienen un <b>LED de internet o LOS que indican si tienen señal</b>.</li><li>Si ves un error en el módem u ONT o en los cables que tiene, será mejor <b>hablar con tu proveedor</b> para que te dé asistencia.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'No_enciende':
            campo3.innerHTML = '<h3>¿Tu equipo no enciende?</h3><ul><li>Revisa que esté bien <b>conectado a la electricidad</b>.</li><li>Usualmente hay un <b>LED que indica si está conectado</b> a la electricidad. ¿Está encendido?</li><li>Intenta <b>conectar tu equipo directo al enchufe de la pared</b>. Puede que la extensión o regleta no funcione.</li><li>¿Se escuchan los ventiladores? Puede que <b>la pantalla no esté funcionando</b>. Intenta conectar otra pantalla.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'pantalla_azul':
            campo3.innerHTML = '<h3>¡Un pantallazo azul!</h3><ul><li><b>Intenta apagarla</b>. Se puede hacer dejando presionado el botón de encender por 10 segundos y luego encenderla otra vez.</li></ul><p>Con esto no hay mucho que hacer. Si no funcionó el reiniciarla, <b>contacta al equipo de soporte</b>.</p>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'se_traba':
            campo3.innerHTML = '<h3>¿Tu equipo se está trabando?</h3><ul><li>Intenta <b>reiniciar tu equipo</b>, eso cerrará programas que están causando problemas.</li><li>Si es tu sesión remota, <b>revisa tu internet</b>. Si el internet está lento o inestable, tardarás en ver lo de tu sesión y sentirás que va lento.</li><li>Puede que un programa no esté funcionando. Para forzar a cerrarlo, puedes presionar los botones de <b>Ctrl + Alt + Supr</b> en tu teclado. En la opción de <b>Administrador de tareas</b>, esa ventana te indicará si un programa tiene problemas y podrás cerrarlo dando en la opción de "Finalizar tarea". <b><br>CUIDADO: TODO LO QUE ESTABAS HACIENDO EN ESE PROGRAMA SE BORRARÁ SI NO ESTABA GUARDADO.</b></li><li>Puede que sea momento de <b>llevarla al área de sistemas</b> para que le den mantenimiento.</li></ul>';
            campo3.classList.remove("d-none");
            cambiar = 1;
            break;
        case 'mouse':
            campo3.innerHTML = '<h3>¿Tu mouse está fallando?</h3><ul><li><b>La tierra se acumula en la parte de abajo</b>, a veces tapando el láser. Límpiala y funcionará mejor.</li><li>Los mouse inalámbricos tienen una tapa en la parte de abajo. Al quitarla podrás ver <b>la batería, puedes reemplazarla</b> sin problemas. <b>Ve al área de sistemas</b> para que te podamos dar otra.</li><li>Puede que de verdad ya no funcione, visita el área de sistemas para que puedan darte otro.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'teclado':
            campo3.innerHTML = '<h3>¿Tu teclado está fallando?</h3><ul><li>Si es un teclado individual, puede que tenga algo de tierra atorada. Voltéalo y dale algunos golpes en la parte de atrás. Eso sacará la tierra que tenga atorada.</li><li>Si es el teclado de la laptop, puedes limpiarlo con cuidado con un trapo algo húmedo.</li><li>Contacta a el área de sistemas para ver otras opciones.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'adaptador_red':
            campo3.innerHTML = '<h3>¿No está funcionando el adaptador de red USB?</h3><ul><li><b>Revisa que esté bien conectado</b>. La mayoría tienen un LED que indica si está funcionando. Intenta desconectarlo y conectarlo en otro puerto de tu equipo.</li><li>Si está bien conectado, <b>revisa que esté bien conectado el cable de red al adaptador</b> y que el equipo no mencione "Conectado sin internet". En este caso, probablemente sea el cable que no está bien conectado o que no tengas internet en tu módem u ONT.</li><li>Si el adaptador tiene algún daño visible, <b>llévalo al área de sistemas para revisarlo.</b></li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'app_kiosko':
        case 'app_recibos':
            campo3.innerHTML = '<h3>¿Una aplicación no funciona o va lento?</h3><ul><li>Revisa que tu equipo esté <b>conectado a internet</b>, puedes usar los consejos de la sección de"conexión->no tengo internet"</li><li>¿Cuál navegador estás usando?</li><ul><li>Internet Explorer, ya es algo viejo y <b>ya no funciona bien</b>, no lo uses</li><li>Chrome, a veces se tarda más en cargar</li><li><b>Firefox</b>, es el más <b>recomendado</b> para usar en la mayoría de nuestras aplicaciones</li></ul><li>Revisa que tu usuario y contraseña esten correctos puedes revisarlos en el apartado de "Mi informacion"</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'enviar_correo':
        case 'recibir_correo':
            campo3.innerHTML = '<h3>¿Tu correo no funciona bien?</h3><ul><li><b>Revisa tu conexion a internet</b>, puedes usar los consejos de "La conexion->no tengo internet</li><li><b>Dale unos minutos</b>, hay correos que tardan hasta 30 minutos llegar a su destino</li><li><b>Revisa tu usuario y contraseña</b>, los puedes consultar en el apartado de "Mi informacion"</li><li>Si el problema persiste, <b>contacta a soporte</b></li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'conectar_correo':
            campo3.innerHTML = ' <h3>Tu correo donde estes</h3><ol><li>Busca la opción de <b>configuración</b> de tu correo en el dispositivo</li><li>Ve a la opcion de <b>agregar cuenta</b></li><li>Te pedira tu usuario y contraseña, los puedes ver en tu apartado de "Mi informacion"</li><li>Si te pregunta, es una cuenta tipo <b>POP</b></li><li>El host de <b>entrada</b> es "imap.hostinger.com" con el puerto <b>995</b></li><li>El host de <b>salida</b> es "smtp.hostinger.com" con el puerto <b>465</b></li></ol><p>Si sigues con problema puedes contactar al area de soporte para que te podamos ayudar</p>';
            campo3.classList.remove("d-none");
            tiempo();
            break;

        case 'sesión_lenta':
            campo3.innerHTML = '<h3>¿Tu sesión no funciona como debería?</h3><ul><li><b>Revisa tu internet</b>. Si el internet está lento o inestable, tardarás en ver lo de tu sesión y sentirás que va lento.</li><li>Revisa si no es tu computadora la que está fallando. Los consejos de "Mi PC->Se traba mucho" podrían funcionar.</li><li>Puede que algún programa o proceso esté interfiriendo con el servidor. Mejor <b>avisa al área de sistemas</b> para que puedan revisarlo.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'servidor_no_responde':
            campo3.innerHTML = '<h3>¡¿El servidor no responde?!</h3><ul><li>Revisa que tu equipo esté <b>conectado a internet</b>. Puedes usar los consejos de la sección de "Conexión->No tengo internet".</li><li>Si estás fuera de la oficina, revisa que tu equipo esté <b>conectado a la VPN</b>. Puedes usar los consejos de "Conexión->No me puedo conectar a la VPN".</li><li>Si estás seguro/segura de que todo está conectado correctamente, <b>avisa al área de sistemas</b>. Puede que algo esté pasando con el servidor.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'sesión_contreseña':
            campo3.innerHTML = '<h3>¿No puedes entrar a tu sesión?</h3><ul><li>Revisa que tu equipo esté <b>conectado a internet</b>. Puedes usar los consejos de la sección de "Conexión -> No tengo internet".</li><li>Si estás fuera de la oficina, revisa que tu equipo esté <b>conectado a la VPN</b>. Puedes usar los consejos de "Conexión -> No me puedo conectar a la VPN".</li><li>Si estás seguro/segura de que todo está conectado correctamente, <b>avisa al área de sistemas</b>. Puede que algo esté pasando con el servidor.</li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'oficce_se_traba':
            campo3.innerHTML = '<h3>¿Sientes que office se traba?</h3><ul><li>Si estás conectado(a) a tu sección en el servidor, revisa tu conexión de internet, si tu internet no funciona bien, tardarás en ver que pasa en tu sesión, puedes ver los consejos de "CONEXIÓN -> NO TENGO INTERNET"</li><li>Si no has cerrado tu sección en un tiempo, <b>puede que la estés saturando</b><ol><li>Has click en el <b>botón de inicio</b></li><li>Al hacer clic en tu nombre tendrás la opción de "<b>Cerrar sesión</b>"</li><li><b>Dale unos minutos</b> para que todo termine de cerrarse</li><li>Después podrás <b>iniciar otra vez<b>, revisa que ya esté funcionando bien</li></ol></li></ul>';
            campo3.classList.remove("d-none");
            tiempo();
            break;
        case 'Mantenimiento':
            mostrar_enviar(1);
            tiempo();
            break;
        case 'Timbrado/cancelacion':
            confirmartimbrado();
            let anio = new Date();
            campo3.classList.add("d-none");
            document.getElementById('Ejercicio').value = anio.getFullYear();
            divtimbrado.classList.remove("d-none");
            txt_detalles.required = false;
            divtimbrado.addEventListener('change', confirmartimbrado);
            divtimbrado.addEventListener('keyup', confirmartimbrado);
            break;
        case 'Consulta_Timbrado':
            mostrar_enviar(1);
            //btnResolver.classList.remove("d-none");
            break;
        case 'Otra_cosa':
            campo3.innerHTML = '<h3>¿Necesitas ayuda con algo más?</h3><ul><li><b>Lee las opciones que te damos</b>, puede que alguna de esas arregle tu problema sin tener que esperar.</li><li>También puedes llamarnos a las <b>extensiones 138 y 140</b>, con gusto te atenderemos.</li></ul>';
            campo3.classList.remove("d-none");
            mostrar_enviar(1);
            break;

        case 'mantenimiento':
            campo3.innerHTML = '<h3>¿Crees que tu equipo necesita mantenimiento?</h3><ul><li>¿Tu equipo hace mucho ruido?</li><li>¿Se te calló agua o algun liquido encima?</li><li>¿te aparece la pantalla negra con letras blancas?</li><li>¿Esta muy lenta?</li></ul><p>No hay problema, estamos para ayudarte.<br> Solo recuerda que nos tardaremos algunas horas para poder terminarlo</p>';
            campo3.classList.remove("d-none");
            mostrar_enviar(1);
            break;

            case 'respuesta_automatica':
            campo3.innerHTML = '<h3>¿Vas a salir de vacaciones? ¿Te vas a tomar unos días? </h3><p>Hay que activar a respuesta de correo automática, solo avísanos </p><ul><li>¿Qué día te vas?</li><li>¿Qué día regresas?</li><li>¿Necesitas que pongamos algún mensaje en particular?</li></ul>';
            campo3.classList.remove("d-none");
            mostrar_enviar(1);
            break;

        default:
            reset();
            break;
    }
}
function tiempo() {
    timeoutId = setTimeout(function () {
        btnResolver.classList.remove("d-none");
        //btnResolver.setAttribute("data-aos", "fade-down");
    }, 5000);
}

function tipocancelado() {
    const div_tipo_cancelado = document.getElementById('div_tipo_cancelado');
    if (btn_Cancelación.checked) {
        div_tipo_cancelado.classList.remove("d-none");
        tipo_cancelado.required = true;
    } else {
        div_tipo_cancelado.classList.add("d-none");
        tipo_cancelado.required = false;
    }
}

function mostrar_enviar(estado) {
    if (estado == 1) {
        divDetalles.classList.remove("d-none");
        btn_botonguardar.classList.remove("d-none");
        btnSalir.classList.add("d-none");
        txt_detalles.required = true;

    } else {
        divDetalles.classList.add("d-none");
        btn_botonguardar.classList.add("d-none");
        btnSalir.classList.remove("d-none");
        txt_detalles.required = false;
    }
}

function reset() {
    console.log("reset");
    clearTimeout(timeoutId);
    btnResolver.classList.add("d-none");
    divDetalles.classList.add("d-none");
    btnSalir.classList.add("d-none");
    btn_botonguardar.classList.add("d-none");
    txt_detalles.required = true;
}

function confirmartimbrado() {
    let i = 0;
    var tipo_cancelado = document.getElementById('tipo_cancelado');

    if (in_empresa.value > 0) {
        i++;
        in_empresa.classList.remove("faltaTimbrado");
    } else {
        in_empresa.classList.add("faltaTimbrado");
    }
    if (in_Ejercicio.value > 4) {
        i++;
        in_Ejercicio.classList.remove("faltaTimbrado");
    } else {
        in_Ejercicio.classList.add("faltaTimbrado");
    }
    if (in_Periodo.value > 0) {
        i++;
        in_Periodo.classList.remove("faltaTimbrado");
    } else {
        in_Periodo.classList.add("faltaTimbrado");
    }
    if (cbEmpleados.checked || in_empleados.value.length > 0) {
        i++;
        formEmpleados.classList.remove("faltaTimbrado");
    } else {
        formEmpleados.classList.add("faltaTimbrado");
    }
    if (btn_timbrado.checked || btn_Cancelación.checked) {
        if (!btn_Cancelación.checked) {
            i++;
        } else {
            if (tipo_cancelado.value > 0) {
                tipo_cancelado.classList.remove("faltaTimbrado");
                i++;
            } else {
                tipo_cancelado.classList.add("faltaTimbrado");
            }
        }
        document.getElementById('btn_servicios').classList.remove("faltaTimbrado");
    } else {
        document.getElementById('btn_servicios').classList.add("faltaTimbrado");
    }

    if (i == 5) {
        btn_botonguardar.classList.remove("d-none");
    } else {
        btn_botonguardar.classList.add("d-none");
    }
}

function cargando() {
    console.log('cargando');
    btn_botonguardar.classList.add('d-none');
    botonCargando.classList.remove('d-none');
}





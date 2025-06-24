console.log('Mantenimiento');

const btnGuardar = document.getElementById('botonguardar');
const btnCerrado = document.getElementById('Concluido');
const btnRevisión = document.getElementById('revisión');
const divmantenimiento = document.getElementById('mantenimiento');
const checkboxes = document.querySelectorAll('#mantenimiento .form-check-input');

divmantenimiento.addEventListener('change', bloquear);
btnCerrado.addEventListener('change', bloquear);
btnRevisión.addEventListener('change', bloquear);

function bloquear() {
    if (btnCerrado.checked) {
        if (revisar()) {
            btnGuardar.classList.remove('disabled');
        } else {
            btnGuardar.classList.add('disabled');
        }
    } else {
        btnGuardar.classList.remove('disabled');
    }
}

function revisar() {
    return Array.from(checkboxes).every(checkbox => checkbox.checked);
}
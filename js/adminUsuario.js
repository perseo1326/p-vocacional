//******************************************************************* 
//******************************************************************* 
// ejecucion de los eventos de la parte de Administrador y Psicologo
//******************************************************************* 
//******************************************************************* 

let bCerrarDetalleUsuario   = document.getElementById("bCerrarDetalleUsuario");
let formUsuario             = document.getElementById('formUsuario');
let bMostrarDetallesUsuario = document.getElementById("mostrarDetallesUsuario");
let pDatosPersonales        = document.getElementById('datosPersonales');
let bNotas                  = document.getElementById('bNotas');
let notas                   = document.getElementById('notas');
let bEditarGuardarInfo      = document.getElementById('editarGuardarInfo');
let bCancelarEditarInfo     = document.getElementById('cancelarEditarInfo');
let pErrorRegistro          = document.getElementById('errorRegistro');

let elementos               = document.formUsuario.getElementsByTagName('INPUT');

const EDITAR_INFO           = 'Editar información';
const GUARDAR_DATOS         = "Guardar datos";

let ventanaDetallePreguntas = null;


//******************************************************************* 
// funcion para abrir una nueva ventana, ventana hija
function nuevaVentana() {
    let alto = screen.availHeight;
    let ancho = screen.availWidth;
    ancho = Math.round(ancho / 3);
    alto = Math.round(alto / 6);

    console.log("ventana Detalle Preguntas: ", ventanaDetallePreguntas);

    if (ventanaDetallePreguntas == null || ventanaDetallePreguntas.closed) {
        ventanaDetallePreguntas = window.open('<?php echo RUTA; ?>admin/preguntas.php?id=<?php echo $id; ?>', 'detallePreguntas', 'fullscreen=1,left=' + ancho + ',top=' + alto +',width=' + (2*ancho) + ',height=' + (5*alto) + ',location=0,titlebar=0,menubar=0,scrollbars=1,status=1,resizable=1');
        ventanaDetallePreguntas.focus();
    } else {
        ventanaDetallePreguntas.focus();
    }
}

//******************************************************************* 
function editarInformacion() {

    pDatosPersonales.classList.remove('esconder');
    // pDatosPersonales.classList.remove('resaltar-fondo');
    notas.classList.remove('esconder');
    
    for (let i = 0; i < elementos.length; i++) {
        const element = elementos[i];
        if (element.type == 'text' && element.id != '') {
            element.classList.remove('desactivado');
            element.readOnly = false;
        }
    }
    notas.classList.remove('desactivado');
    notas.readOnly = false;

    bCancelarEditarInfo.parentNode.classList.remove('esconder');        
    bEditarGuardarInfo.dataset['edicion'] = 'true';
    bEditarGuardarInfo.value = GUARDAR_DATOS;
}

//******************************************************************* 
function bloquearInformacion() {

    for (let i = 0; i < elementos.length; i++) {
        const element = elementos[i];
        if (element.type == 'text' && element.id != '') {
            element.classList.add('desactivado');
            element.readOnly = true;
            element.classList.remove('errores');
        }
    }
    notas.classList.add('desactivado');
    notas.readOnly = true;

    pErrorRegistro.classList.remove('errores');
    pErrorRegistro.innerHTML = '';

    bEditarGuardarInfo.value = EDITAR_INFO;
    bEditarGuardarInfo.dataset['edicion'] = 'false';
    bCancelarEditarInfo.parentNode.classList.add('esconder');
}

//******************************************************************* 
function validarInformacion() {
    
    let valido = false;
    let error = '';
    let mensajeError = '';

    // limpiar todos los errores presentes
    for (let i = 0; i < elementos.length; i++) {
        elementos[i].classList.remove('errores');
    }
    pErrorRegistro.classList.remove('errores');
    pErrorRegistro.innerHTML = '';

    // validar cada uno de los campos
    for (let j = 0; j < elementos.length; j++) {
        const element = elementos[j];
        if (element.type == 'text' && element.id != '') {
            switch (element.id) {
                case ('nombre'):
                    error = validarNombre_Apellido(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += "El Nombre" + error;
                    }
                    break;
                case ('apellido1'):
                    error = validarNombre_Apellido(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += "El primer apellido" + error;
                    }
                    break;
                case ('apellido2'):
                    error = validarNombre_Apellido(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += "El segundo apellido" + error;
                    }
                    break;
                case ('telefono'):
                    error = validarTelefono(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += error;
                    }
                    break;
                case 'nacimiento':
                    let fecha = validarFecha(element.value);
                    if (fecha === false) {
                        element.classList.add("errores");
                        mensajeError += "La fecha no es válida.<br />";
                    } else {
                        // validar si es mayor de EDAD_MIN
                        if (!dentroRangoEdades(element.value, EDAD_MIN)) {
                            element.classList.add("errores");
                            mensajeError += "El usuario NO cumple los requisitos de edad.<br />";				
                        }
                    }
                    break;
                case 'email':
                    error = validarEmail(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += error;
                    }
                    break;
                default:
                    break;
            }
        }
    }
    
    if (mensajeError == '') {
        valido = true;
    } else {
        valido = false;
        pErrorRegistro.classList.add('errores');
        pErrorRegistro.innerHTML = mensajeError;
    }

    return valido;
}

//******************************************************************* 
bCerrarDetalleUsuario.onclick = function () {
    if (ventanaDetallePreguntas == null || ventanaDetallePreguntas.closed) {
        window.close();
    } else {
        ventanaDetallePreguntas.close();
        window.opener.focus();
        window.close();
    }
}

//******************************************************************* 
bMostrarDetallesUsuario.onclick = function (evento) {
    pDatosPersonales.classList.toggle('esconder');
    evento.preventDefault();
}

//******************************************************************* 
bNotas.onclick = function () {
    notas.classList.toggle('esconder');
}

//******************************************************************* 
bEditarGuardarInfo.onclick = function (evento) {

    // if (this.dataset['edicion'] == "false") {
    //     editarInformacion(); 
    // } else {
    //     formUsuario.onsubmit(evento);
    // }

    console.log("guardar info click ", this);
}

//******************************************************************* 
bCancelarEditarInfo.onclick = function () {
    bloquearInformacion();
}

//******************************************************************* 
formUsuario.onsubmit = function (evento) {
    
    if (bEditarGuardarInfo.dataset['edicion'] == "false") {
        editarInformacion(); 
        evento.preventDefault();
        console.log("ONSUBMIT -> Editando informacion...", this);
    } else {
        if (validarInformacion()) {
            bloquearInformacion();
            console.log("Enviando formulario.");
            // evento.preventDefault();
        } else {
            console.log("Cancelando envio de formulario.");
            evento.preventDefault();
        }
    }


}


//******************************************************************* 

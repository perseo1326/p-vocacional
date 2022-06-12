var ventanaDetallePreguntas = null;

function nuevaVentana() {
    let alto = screen.availHeight;
    let ancho = screen.availWidth;
    ancho = Math.round(ancho / 3);
    alto = Math.round(alto / 6);

    console.log(ventanaDetallePreguntas);

    if (ventanaDetallePreguntas == null || ventanaDetallePreguntas.closed) {
        ventanaDetallePreguntas = window.open('<?php echo RUTA; ?>admin/preguntas.php?id=<?php echo $id; ?>', 'detallePreguntas', 'fullscreen=1,left=' + ancho + ',top=' + alto +',width=' + (2*ancho) + ',height=' + (5*alto) + ',location=0,titlebar=0,menubar=0,scrollbars=1,status=1,resizable=1');
        ventanaDetallePreguntas.focus();
    } else {
        ventanaDetallePreguntas.focus();
    }
}

// variable permite controlar las clases segun este en modo edicion o solo lectura
var campos = [];
var valoresOriginales = [];
campos[0] = document.getElementById('nombre');
campos[1] = document.getElementById('apellido1');
campos[2] = document.getElementById('apellido2');
campos[3] = document.getElementById('telefono');
campos[4] = document.getElementById('email');
campos[5] = document.getElementById('notas');

//******************************************************************* 
// copiar los valores actuales de las variables para comparar mas adelante
valoresOriginales[0] = campos[0].value;
valoresOriginales[1] = campos[1].value;
valoresOriginales[2] = campos[2].value;
valoresOriginales[3] = campos[3].value;
valoresOriginales[4] = campos[4].value;
valoresOriginales[5] = campos[5].value;

//******************************************************************* 
// funcion para habilitar los campos de la busqueda para actualizar informacion del usuario
function habilitarCamposDatos(campos, estado) {
    // si es verdadero => habilitar campos, sino bloquearlos(readonly)
    if (estado) {
        console.log("habilitar campos...");
        // console.log(campos);
        campos[0].readOnly = false;
        campos[1].readOnly = false;
        campos[2].readOnly = false;
        campos[3].readOnly = false;
        campos[4].readOnly = false;
        campos[5].readOnly = false;
        // cambiar la clase css para cambiar el fondo a blanco
        campos[0].classList.remove('desactivado');
        campos[1].classList.remove('desactivado');
        campos[2].classList.remove('desactivado');
        campos[3].classList.remove('desactivado');
        campos[4].classList.remove('desactivado');
        campos[5].classList.remove('desactivado');

    } else {
        console.log("DEShabilitar campos...");
        campos[0].readOnly = true;
        campos[1].readOnly = true;
        campos[2].readOnly = true;
        campos[3].readOnly = true;
        campos[4].readOnly = true;
        campos[5].readOnly = true;
        // cambiar la clase css para cambiar el fondo a gris
        campos[0].classList.add('desactivado');
        campos[1].classList.add('desactivado');
        campos[2].classList.add('desactivado');
        campos[3].classList.add('desactivado');
        campos[4].classList.add('desactivado');
        campos[5].classList.add('desactivado');
    }
}

//******************************************************************* 
function editarInformacion(idBoton) {
    console.log("Editar info usuario ...");
    let modoEdicion = false;
    let error = "";
    let boton = document.getElementById(idBoton);
    // panel donde visualizaremos errores en las validaciones
    let panelDatosPersonales = document.getElementById("datosPersonales");
    let pErrorDatos = document.getElementById('errorDatos');

    pErrorDatos.innerHTML = "";
    pErrorDatos.classList.remove("errores");

    if (boton.value == 'Editar Información') {
        // habilitar los campos de edicion 
        habilitarCamposDatos(campos, true);
        // cambiar el titulo del boton 
        boton.value = 'Guardar Datos';
        mostrarFormulario('notas', 'nombre');
        panelDatosPersonales.classList.remove("esconder");    
        document.getElementById("cancelarEdicion").classList.remove("esconder");    
    } else {

        // se detectaron cambios, es necesario guardar la nueva info
        for (let i = 0;
            (i < valoresOriginales.length); i++) {
            if (valoresOriginales[i] != campos[i].value) {
                console.log("valores a guardar: ", campos[i]);
                modoEdicion = true;

                let x = false;
                switch (campos[i].id) {
                    case "nombre":
                    case "apellido1":
                    case "apellido2":
                        x = validarNombre_Apellido(campos[i].value);
                        if (x != false) {
                            switch (campos[i].id) {
                                case 'nombre':
                                    dato = 'Nombre';
                                    break;
                                case 'apellido1':
                                    dato = 'Primer apellido';
                                    break;
                                case 'apellido2':
                                    dato = 'Segundo apellido';
                                    break;
                                default:
                                    break;
                            }
                            error += ' "' + dato + '"' + x;
                        }                        
                        break;
                    case "telefono":
                        x = validarTelefono(campos[i].value);
                        if (x != false) {
                            error += x;
                        }
                    case "email":
                        x = validarEmail(campos[i].value);
                        if (x != false) {
                            error += x;
                        }
                    default:
                        console.log("en switch cambios a guardar case DEFAULT: ", campos[i].id);
                        break;
                }
            }
        }

        // Si hay cambios y los campos no contienen errores => ...
        if (error == "") {
            document.getElementById("cancelarEdicion").classList.add("esconder");    

            // deshabilitar los campos de edicion
            habilitarCamposDatos(campos, false);
            //cambiar el titulo del boton
            boton.value = 'Editar Información';
            if (modoEdicion) {
                alert('Enviando formulario');
                document.getElementById('formUsuario').submit();
            }
        } else {
            pErrorDatos.innerHTML = error;
            pErrorDatos.classList.add("errores");
        }
    }
}


//******************************************************************* 
//******************************************************************* 
// ejecucion de los eventos de la parte de Administrador y Psicologo
//******************************************************************* 
//******************************************************************* 

let bMostrarDetallesUsuario = document.getElementById("mostrarDetallesUsuario");
let bNombreAdmin            = document.getElementById("nombre"); 
let bApellido1              = document.getElementById('apellido1');
let bApellido2              = document.getElementById('apellido2');
let bTelefono               = document.getElementById('telefono');
let bEmail                  = document.getElementById('email');

let bEditarGuardarInfo      = document.getElementById('editarGuardarInfo');
let bCancelarEditarInfo     = document.getElementById('cancelarEditarInfo');

let bCerrarDetalleUsuario   = document.getElementById("bCerrarDetalleUsuario");

bMostrarDetallesUsuario.addEventListener('click', function (evento){ esconderPanel('datosPersonales'); evento.preventDefault(); }, true);
// bMostrarDetallesUsuario.onclick = function(evento) {
//     console.log("boton datos personales extras!!"); 
//     esconderPanel('datosPersonales'); 
//     evento.preventDefault(); 
// }

// evento 'onblur' ejecutado cuando un elemento pierde el focus.
// onblur="javascript:validarTextosEdicion('nombre', false)"
bNombreAdmin.addEventListener("onblur", function (){ validarTextosEdicion('nombre', false); console.log("Onblur: nombre ") } );

// onblur="javascript:validarTextosEdicion('apellido1', false)"
bApellido1.addEventListener("onblur", function (){ validarTextosEdicion('apellido1', false); console.log("Onblur: apellido1 ") } );
bApellido2.addEventListener("onblur", function (){ validarTextosEdicion('apellido2', false); console.log("Onblur: apellido2 ") } );

// onblur="javascript:validarNumerosTelEdicion('telefono', false)" 
bTelefono.addEventListener("onblur", function (){ validarNumerosTelEdicion('telefono', false); console.log("Onblur: telefono ") } );

// onblur="javascript:validarEmailFormularioEdicion('email')"
bEmail.addEventListener("onblur", function() { validarEmailFormularioEdicion('email') });

bEditarGuardarInfo.onclick = function() {
    console.log("valor de this: ", this);
    editarInformacion('editarGuardarInfo', true); 
}

bCancelarEditarInfo.onclick = function() {
    for (let i = 0;
        (i < valoresOriginales.length); i++) {
            if (valoresOriginales[i] != campos[i].value) {
                campos[i].value = valoresOriginales[i];
            }
        }
    console.log("Valores originales ", bEditarGuardarInfo);
    editarInformacion('editarGuardarInfo', false); 
}

bCerrarDetalleUsuario.onclick = function () {
    if (ventanaDetallePreguntas == null || ventanaDetallePreguntas.closed) {
        window.close();
    } else {
        ventanaDetallePreguntas.close();
        window.opener.focus();
        window.close();
    }
}
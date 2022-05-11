//******************************************************************* 
//******************************************************************* 
// Script para hacer las validaciones de la seccion de busquedas para 
// el tipo de usuario PSICOLOGO
//******************************************************************* 
//******************************************************************* 

//******************************************************************* 
// funcion para habilitar/deshabilitar los imputs de fechas en la pagina
// "admin/index.view.php"
function activarFechas(visible) {
    let fDesde = document.getElementById('fechaDesde');
    let fHasta = document.getElementById('fechaHasta');
    if (visible) {
        fDesde.disabled = false;
        fHasta.disabled = false;
    } else {
        fDesde.disabled = true;
        fDesde.value = "";
        fDesde.className = "";
        fHasta.disabled = true;
        fHasta.value = "";
        fHasta.className = "";
    }
}

//******************************************************************* 
// funcion para validar los datos ingresados en la pagina de busquedas
function validarFormBusqueda() {
    console.log("validarFormBusqueda");
//   let nombre = document.getElementById('nombre');
//   let apellido1 = document.getElementById('apellido1');
//   let apellido2 = document.getElementById('apellido2');
//   let telefono = document.getElementById('telefono');
//   // return false;
 }

//******************************************************************* 
// funcion para habilitar los campos de la busqueda para actualizar informacion del usuario
function habilitarCamposDatos(campos, estado) {
    // si es verdadero => habilitar campos, sino bloquearlos(readonly)
    if (estado) {
        console.log("habilitar campos...");
        console.log(campos[0]);
        campos[0].readOnly = false;
        campos[1].readOnly = false;
        campos[2].readOnly = false;
        campos[3].readOnly = false;
        campos[4].readOnly = false;
        campos[5].readOnly = false;
        // cambiar la clase css para cambiar el fondo a blanco
        campos[0].className = '';
        campos[1].className = '';
        campos[2].className = '';
        campos[3].className = '';
        campos[4].className = '';
        campos[5].className = '';

    } else {
        console.log("DEShabilitar campos...");
        campos[0].readOnly = true;
        campos[1].readOnly = true;
        campos[2].readOnly = true;
        campos[3].readOnly = true;
        campos[4].readOnly = true;
        campos[5].readOnly = true;
        // cambiar la clase css para cambiar el fondo a gris
        campos[0].className = 'desactivado';
        campos[1].className = 'desactivado';
        campos[2].className = 'desactivado';
        campos[3].className = 'desactivado';
        campos[4].className = 'desactivado';
        campos[5].className = 'desactivado';
    }
}

// *************************************************************************
// funcion para verificar el texto de un input y cambiar la clase segun el estado
// tener encuenta que si esta en modo edicion se debe poner una clase, ("")
// si esta en modo solo lectura se debe poner otra clase (.desactivado)

// funcion para usar con el evento "onblur" y validar los textos 
// si el segundo parametro se coloca a true => permite que "" sea aceptado
// en el 3er parametro se puede indicar una clase CSS a ser aplicada en caso que NO haya error
function validarTextosEdicion(id, permitirEspacio) {
    // Si modoEdicion es true => en edicion, sino es readOnly
    if (modoEdicion) {
        validarTextos(id, permitirEspacio, '');
    } else {
        validarTextos(id, permitirEspacio, 'desactivado');
    }
}

function validarNumerosTelEdicion(id, permitirEspacio) {
    // Si modoEdicion es true => en edicion, sino es readOnly
    if (modoEdicion) {
        validarNumerosTel(id, permitirEspacio, '');
    } else {
        validarNumerosTel(id, permitirEspacio, 'desactivado');
    }
}

function validarEmailFormularioEdicion(id) {
  // Si modoEdicion es true => en edicion, sino es readOnly
  if (modoEdicion) {
    validarEmailFormulario(id, '');
  } else {
    validarEmailFormulario(id, 'desactivado');
  }
}

    //******************************************************************* 
function editarInformacion(idBoton) {
    let error = "";
    let boton = document.getElementById(idBoton);
    if (boton.value == 'Editar Información') {
        // habilitar la variable que indica el modo de edicion
        modoEdicion = true;
        // habilitar los campos de edicion 
        habilitarCamposDatos(campos, true);
        // cambiar el titulo del boton 
        boton.value = 'Guardar Datos';
        mostrarFormulario('notas', 'nombre');
    } else {
        // variable qeu indica si hubieron cambios en los datos que sean necesarios guardar
        // let guardar = false;
        // modoEdicion = false;
        for (let i = 0;
            (i < valoresOriginales.length && modoEdicion); i++) {
            if (valoresOriginales[i] != campos[i].value) {
                // se detectaron cambios, es necesario guardar la nueva info
                modoEdicion = true;
                break;
            }
        }
        // validar el nombre
        x = validarNombre_Apellido(document.getElementById('nombre').value);
        if (x != false) {
            error += "\"Nombre\" " + x;
        }
        // validar el primer apellido
        x = validarNombre_Apellido(document.getElementById('apellido1').value);
        if (x != false) {
            error += "\"Primer Apellido\" " + x;
        }
        // validar el segudno apellido
        x = validarNombre_Apellido(document.getElementById('apellido2').value);
        if (x != false) {
            error += "\"Segundo Apellido\" " + x;
        }
        // validar el telefono
        x = validarTelefono(document.getElementById('telefono').value);
        if (x != false) {
            error += x;
        }
        // validar el email
        x = validarEmail(document.getElementById('email').value);
        if (x != false) {
            error += x;
        }

        // Si hay cambios y los campos no contienen errores => ...
        if (error == "") {
            // deshabilitar los campos de edicion
            habilitarCamposDatos(campos, false);
            //cambiar el titulo del boton
            boton.value = 'Editar Información';
            if (modoEdicion) {
                // alert('Enviando formulario');
                modoEdicion = false;
                document.getElementById('formUsuario').submit();
            }
        } else {
            document.getElementById('errorDatos').innerHTML = error;
            document.getElementById('errorDatos').className = "error";
        }
    }
}
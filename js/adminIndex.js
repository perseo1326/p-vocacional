
    let tNombre             = document.getElementById('nombre');
    let tApellido1          = document.getElementById('apellido1');
    let tApellido2          = document.getElementById('apellido2');

    let sinFecha            = document.getElementById("noFecha");
    let fechaNacimiento     = document.getElementById('nacimiento');
    let fechaExamen         = document.getElementById('examen');

    // forma de seleccionar elementos dentro de un "form"
    let rTipoFecha          = document.formBusquedas.tipoFecha;

    let cuadroFechas        = document.getElementById("contenedorFecha");
    let fDesde              = document.getElementById('fechaDesde');
    let fHasta              = document.getElementById('fechaHasta');

    // let pErrorRegistro      = document.getElementById('errorRegistro');
    let pErrorRegistro      = document.getElementById('resultados');
    let formBuscar          = document.getElementById('formBuscar');
    let bLlimpiarFormulario = document.getElementById('limpiarFormulario');   


//*******************************************************************

        var ventanaDetalle = null;
        let x = document.getElementById('resultados');
        
        function abrirVentanadetalle(url) {
            console.log("URL= " + url);
            ventanaDetalle = window.open(url, 'ventanaDetalle', 'fullscreen=1,location=1,titlebar=1,menubar=1,scrollbars=1,status=1,resizable=1');
        }

        if (x.innerText != '') {
            x.focus();
        }

//******************************************************************* 
// funcion para habilitar/deshabilitar los imputs de fechas en la pagina
// "admin/index.view.php"
function activarFechas(visible) {

    if (visible) {
        console.log("Visible true");
        cuadroFechas.classList.remove("deshabilitar-fecha");
        fDesde.disabled = false;
        fHasta.disabled = false;
    } else {
        console.log("visible false");
        cuadroFechas.classList.add("deshabilitar-fecha");
        fDesde.disabled = true;
        fDesde.value = "";
        fHasta.disabled = true;
        fHasta.value = "";
    }
}

//******************************************************************* 
// funcion para validar los datos ingresados en la pagina de busquedas
function validarFormBusqueda() {

	let elementos       = [tNombre, tApellido1, tApellido2, sinFecha, fechaNacimiento, fechaExamen];
    let validacion      = false;
    let error           = "";
    let mensajeError    = "";

	// remover la clase "errores" de todos los elementos antes de la comprobacion
	elementos.forEach(element => {
		element.classList.remove('errores');
	});
	pErrorRegistro.innerText = "";

    // comprobacion de errores antes de enviar el formulario
    elementos.forEach(element => {
        switch (element.id) {
            case 'nombre':
                if (element.value != "") {
                    error = validarNombre_Apellido(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += "El Nombre" + error;
                    }
                }
                break;
            case ('apellido1'):
                if (element.value != "") {
                    error = validarNombre_Apellido(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += "El primer apellido" + error;
                    }
                }
                break;
            case ('apellido2'):
                if (element.value != "") {
                    error = validarNombre_Apellido(element.value);
                    if (error !== false) {
                        element.classList.add("errores");
                        mensajeError += "El segundo apellido" + error;
                    }
                }
                break;
            case 'noFecha':
                console.log("valor de noFecha:", element.checked);
                break;
            case 'nacimiento':
            case 'examen':
                if (element.checked) {
                    fDesde.value = fDesde.value.trim();
                    fHasta.value = fHasta.value.trim();

                    // false => fecha NO valida!                
                    if (validarFecha(fDesde.value) === false) { 
                        fDesde.classList.add('errores');
                        mensajeError += 'Fecha Desde Introduzca una fecha válida.<br>';
                    } else {
                        fDesde.classList.remove('errores');
                    }

                    if (validarFecha(fHasta.value) === false) {
                        fHasta.classList.add('errores');
                        mensajeError += 'Fecha Hasta Introduzca una fecha válida.<br>';
                    } else {
                        fHasta.classList.remove('errores');
                    }
                }
                console.log("Nacimiento o Examen: ", element);
                break;
            default:
                console.log("Error inesperado!!");
                mensajeError += "Error inesperado!!";
                pErrorRegistro.classList.add("errores");
                break;
        }
    });

    if (mensajeError == "") {
        validacion = true;
    } else {
        pErrorRegistro.classList.add('errores');
        pErrorRegistro.innerHTML = mensajeError;
        validacion = false;
    }
    return validacion;
}

//*******************************************************************
// Funcion para impiar el formulario de busqueda de valores previos
function limpiarFormulario() 
{
    pErrorRegistro.innerText = "";
    pErrorRegistro.classList.remove("errores");

    let elementos = document.getElementsByTagName("INPUT");

    for (let i = 0; i < elementos.length; i++) {
        if (elementos[i].type == "text" || elementos[i].type == "date") {
            elementos[i].value = "";
            elementos[i].classList.remove('errores');
        } 
    }
    sinFecha.click();
}

//*******************************************************************
tNombre.onblur = function () {
    this.value = this.value.trim();
    if (this.value != "") {
        let error = validarNombre_Apellido(this.value);
        mostrarErrores(this, error, 'El Nombre ');
    } else {
		this.classList.remove("errores");
        removerErrores();
    }
}

// ***************************************************************
tApellido1.onblur = function () {
	this.value = this.value.trim();
    if (this.value != "") {
        let error = validarNombre_Apellido(this.value);
        mostrarErrores(this, error, 'El Primer Apellido ');
    } else {
        this.classList.remove("errores");
        removerErrores();
    }
}

// ***************************************************************
tApellido2.onblur = function () {
	this.value = this.value.trim();
    if (this.value != "") {
        let error = validarNombre_Apellido(this.value);
        mostrarErrores(this, error, 'El Segundo Apellido ');
    } else {
        this.classList.remove("errores");
        removerErrores();
    }
}

//*******************************************************************
fDesde.onblur = function () {
    this.value = this.value.trim();
	// false => fecha NO valida!
	let error = validarFecha(this.value);

	if (error === false) {
		mostrarErrores(this, 'Introduzca una fecha válida.');
	} else {
		mostrarErrores(this, false);
	}
}

//*******************************************************************
fHasta.onblur = function () {
    this.value = this.value.trim();
    // false => fecha NO valida!
	let error = validarFecha(this.value);

	if (error === false) {
		mostrarErrores(this, 'Introduzca una fecha válida.');
	} else {
		mostrarErrores(this, false);
	}
}

//*******************************************************************
sinFecha.onclick = function () {
    activarFechas(false);
    console.log("SinFecha: ", this);
}

//*******************************************************************
fechaNacimiento.onclick = fechaExamen.onclick = function () {
    activarFechas(true);
}

//*******************************************************************
bLlimpiarFormulario.onclick = function () {
    limpiarFormulario();
}

//*******************************************************************
formBuscar.onsubmit = function (evento) {
    if (validarFormBusqueda()) {
        console.log("Enviando Formulario");
        // TODO -> comentar siguiente linea si desea anular el onsubmit
        // evento.preventDefault();
    } else {
        console.log("Cancelado envio datos");
        evento.preventDefault();
    }
}


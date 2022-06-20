
let tUsuarioId 			= document.getElementById('usuarioId');
let tPassword			= document.getElementById('password');
let tPassword2			= document.getElementById('password2');
let tNombre				= document.getElementById('nombre');
let tApellido1			= document.getElementById('apellido1');
let tApellido2			= document.getElementById('apellido2');
let tNacimiento			= document.getElementById('nacimiento');
let tTelefono			= document.getElementById('telefono');
let tEmail				= document.getElementById('email');
// panel ppara visualizar el tipo de error
let pErrorRegistro		= document.getElementById('errorRegistro');
let bCancelarRegistro	= document.getElementById('bCancelarRegistro');
let formNuevoUsuario	= document.getElementById('formNuevoUsuario');

//*******************************************************************
tUsuarioId.onblur = function () {
	this.value = this.value.trim();
	let error = validarUserID(this.value);
	mostrarErrores(this, error);
}

//*******************************************************************
tPassword.onblur = function () {
	this.value = this.value.trim();
	let error = validarPasswords(tPassword.value, tPassword2.value);
	mostrarErrores(this, error);
	mostrarErrores(tPassword2, error);
}

//*******************************************************************
tPassword2.onblur = function () {
	this.value = this.value.trim();
	let error = validarPasswords(tPassword.value, tPassword2.value);
	mostrarErrores(this, error);
	mostrarErrores(tPassword, error);
}

// ***************************************************************
tNombre.onblur = function () {
	this.value = this.value.trim();
	let error = validarNombre_Apellido(this.value);
	mostrarErrores(this, error, 'El Nombre ');
}

// ***************************************************************
tApellido1.onblur = function () {
	this.value = this.value.trim();
	let error = validarNombre_Apellido(this.value);
	mostrarErrores(this, error, 'El Primer Apellido ');
}

// ***************************************************************
tApellido2.onblur = function () {
	this.value = this.value.trim();
	let error = validarNombre_Apellido(this.value);
	mostrarErrores(this, error, 'El Segundo Apellido ');
}

// ***************************************************************
tNacimiento.onblur = function () {
	// false => fecha NO valida!
	let error = validarFecha(this.value);

	if (error === false) {
		mostrarErrores(this, 'Introduzca una fecha válida.');
	} else {
		mostrarErrores(this, false);
	}
}

// ***************************************************************
tTelefono.onblur = function () {
	this.value = this.value.trim();
	let error = validarTelefono(this.value);
	mostrarErrores(this, error);
}

// ***************************************************************
tEmail.onblur = function () {
	this.value = this.value.trim();
	let error = validarEmail(this.value);
	mostrarErrores(this, error);
}

//*******************************************************************
bCancelarRegistro.onclick = function () {
	document.location.href = HOST + 'index.php';
}

//*******************************************************************
formNuevoUsuario.onsubmit = function (evento) {
	let error = validarNuevoUsuario();
	if (error) {
		console.log("enviando formulario Nuevo usuario!");
		// TODO para invalidar el envio del formulario "comentar" la siguiente linea
		// evento.preventDefault();
	} else {
		console.log("Cancelando envio del formulario Nuevo Usuario");
		evento.preventDefault();
	}
	return;
}

// *************************************************************************
// funcion para la verificacion de los datos de registro de un nuevo usuario
function validarNuevoUsuario() {
	// variable para recoger cada uno de los errores para cada validacion
	let error = "";
	
	// variable para indicar que existen errores en la validacion
	let mensajeError = "";

	// let mensajeError = document.getElementById('errorRegistro');
	// pErrorRegistro;

	let elementos = [tUsuarioId, tPassword, tPassword2, tNombre, tApellido1, tApellido2, tNacimiento, tTelefono, tEmail ];

	// remover la clase "errores" de todos los elementos antes de la comprobacion
	elementos.forEach(element => {
		element.classList.remove('errores');
	});
	pErrorRegistro.innerText = "";

	
	//verificaciones en cada uno de los elementos
	elementos.forEach(element => {
		element.value = element.value.trim();
		switch (element.id) {
		case 'usuarioId':
			error = validarUserID(element.value);  
			if (error !== false) {
				element.classList.add('errores');
				mensajeError += error; 
			}
			break;
		case 'password':
		case 'password2': 
			error = validarPasswords(tPassword.value, tPassword2.value);
			if (error !== false) {
				tPassword.classList.add("errorres");
				tPassword2.classList.add("errorres");
				mensajeError += error;
			}
			break;
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
			mensajeError += "Error inesperado.<br />";  
			break;
		}
	});

	// verificar si hubo algun error en la validacion. Sino entonces enviar la forma al servidor.
	if(mensajeError == "") {
		pErrorRegistro.innerHTML = "";
		pErrorRegistro.classList.remove("errores");
		console.log("enviando formulario!!");
		return true;
	} else {
		// cancelar el submit y corregir los errores
		pErrorRegistro.innerHTML = mensajeError;
		pErrorRegistro.classList.add("errores");
		// TODO
		// return true; // override comprobaciones
		return false; // ejecutar comprobaciones
	}
}


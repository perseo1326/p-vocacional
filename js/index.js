
let bNuevoUsuario   = document.getElementById("bNuevoUsuario"); 
let bBotonLogin     = document.getElementById("bBotonLogin");
let bIniciarSesion  = document.getElementById("bIniciarSesion");
let formLogin       = document.getElementById('formLogin');

// *****************************************************
bBotonLogin.onclick = function () {
    document.getElementById('iniciarSesion').classList.toggle("esconder");
    document.getElementById('usuarioId').focus();
}

// *****************************************************
bNuevoUsuario.onclick = function () {
    window.location.href = HOST + 'nuevoUsuario.php';
}

//*******************************************************************
// funcion para la validacion y envio de datos de inicio de sesion desde index.php
function validarLogin() {
    // false = NO enviar datos, contiene errores
    let enviarInfo = false;
    
    let error = "";
    let usuarioId = document.getElementById('usuarioId');
    let passw = document.getElementById('passw');
    let mensajeError = document.getElementById('verErrorLogin');
    
    usuarioId.value = usuarioId.value.trim();
    passw.value = passw.value.trim();

    // limpiar clase de error de los elementos
    usuarioId.classList.remove("errores");
    passw.classList.remove("errores");
    mensajeError.classList.remove("errores");
    mensajeError.innerHTML = '';

    // si el usuario esta vacio...
    if (usuarioId.value == '') {
        usuarioId.classList.add('errores');
        error += "El nombre de usuario NO puede ser vacio!<br>";
    }
    // si la contraseña esta vacia....
    if (passw.value == '') {
        passw.classList.add('errores');
        error += "La contraseña NO puede ser vacia!"
    }
    
    // confirmar o denegar la info para ser enviada al servidor
    if(error == "") {
        console.log("envio aceptado");
        enviarInfo = true;
    } else {
        mensajeError.innerHTML = error;
        mensajeError.classList.add("errores");
        enviarInfo = false;
        console.log("envio fallido");
    }

    return enviarInfo;
}

//*******************************************************************
formLogin.onsubmit = function (evento) {
    if (validarLogin()) {
        // info SI valida, enviar!
        console.log("formLogin submit ");
    } else {
        // info NO valida
        evento.preventDefault();
    }
}

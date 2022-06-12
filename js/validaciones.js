// CONTENIDO
/*
  * Validacion de ID de usuario (basica)
  * validacion de contraseñas en registro de nuevo usuario
  * validacion de Nombres y/o apellidos
  * validacion del formato de un email
  * validacion de numero de telefono
  * validacion de fechas
  * validacion de edad > 18 años
  * validacion de edad < 70 años

*/

// ***************************************************************
// funcion para validar el ID de usuario, NO vacio, ni menor a 8 caracteres
function validarUserID(texto) {
    if (texto == "") {
        return "El usuario ID no puede ser vacio.<br />";
    } else if (texto.match(/[ ñ]/g) != null) {
        return "El usuario ID no puede tener espacios o \"ñÑ\".<br />";
    } else if (texto.length < 8) {
        return "El ID de usuario debe ser de 8 o más caracteres.<br />";
    }
    return false;
}

// ***************************************************************
// funcion para verificar si las contraseñas son iguales
function validarPasswords(pass1, pass2) {
    if (pass1 == "" || pass2 == "") {    
        return "Los campos de contraseñas no pueden estar vacios.<br />";
    }
    if (pass1 != pass2) {
        return "Las contraseñas deben ser iguales.<br />";
    }
    if (pass1.length < 8 || pass2.length < 8) {
        return "La contraseña debe ser de al menos 8 caracteres.<br />";
    }
    // variable para hacer una "Regular Expression" y comparar si hay espacios en el texto
    let patron = /\s/;
    if (patron.test(pass1 || patron.test(pass2))) {
        return "Las contraseñas NO pueden contener espacios.<br />";
    }
    return false;
}

//******************************************************************* 
// funcion para detectar y evitar caracteres NO validos 
// en el input (nombre, apellido1, apellido2)
function validarNombre_Apellido(texto) {
    let patron = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    texto = texto.trim();
    if ( !patron.test(texto)) {
        return " tiene caracteres NO válidos.<br />";
    }
    return false;
    }

//******************************************************************* 
// funcion para validar una direccion de email
function validarEmail(texto) {
    var expRegCorreo=/^\w+@(\w+\.)+\w{2,4}$/; 
    texto = texto.trim();

    if (texto == "") {
        return false;
    }
    if (!expRegCorreo.test(texto)) {
        return "El email no tiene un formato correcto.<br />";
    }
    return false;
}

  //******************************************************************* 
  // funcion para validar el numero de telefono
  // solo se permite en el primer caracater un numero o un (+)
  // en el resto del texto numeros 
  // el minimo de digitos es de seis y si hay presente un + sera de nueve
  // si el texto tiene guiones, no se tendran encuenta para el minimo de digitos 
  // el texto no cumple con el tamaño minimo, se asume que el numero NO es valido

function validarTelefono(texto) {
    // variable para el mensaje de error si hay
    let error = "";
    // variable para revisar si la cantidad de numeros puede ser un tel valido
    let minimoNum = 7;
    let patron1 = /[^+^0-9]/; 
    // expresion regular para permitir GUIONES tambien
    //let patron2 = /[^0-9^-]/;
    let patron2 = /[^0-9]/;
    let patron3 = /[+]/;
    // deshabilitado debido a que se desactivo el uso de guiones(-) 
    //let patron4 = /[-]/g;

    // remmover espacios en blanco de la cadena
    texto = texto.trim();

    // revisar si el primer caracter es un +, si es asi, sumar 3 a minimoNum
    let pos1 = texto.slice(0,1);
    if (patron3.test(pos1)) {
        minimoNum += 3;
    }

    // // existe (-), sumar cada una de sus apariciones y aumentar 
    // //  el numero minimo de caracteres numericos
    // if (patron4.test(texto)) {
    //   let a = texto.match(patron4);
    //   minimoNum += a.length;
    // }

    // Revisar si en la primera posicion hay un + o numeros
    if (patron1.test(pos1)) {
        error += "\"Telefono\": primer caracter (" + pos1 + ") NO es válido.<br />";
    } 

    // revisar si el resto de caracteres son validos
    let rest = texto.slice(1);
    if (patron2.test(rest)) {
        error += "\"Telefono\": por favor unicamente numeros 0-9<br />";
    }
    
    // revisar si la cantidad de caracteres numericos es la minima para un telefono = "minimoNum"
    if (texto.length < minimoNum) {
        error += "\"Telefono\": el número proporcionado parece ser no válido.<br />"
    }

    if (error == "") {
        return false;
    }
    return error;
}

// ***************************************************************
// ******* VALIDACION DE FECHAS **********************************
// ***************************************************************
// conjunto de funciones para verificacion de fechas

// funcion NO usada debido a las expresiones regulares, 
// reemplazada por "validarFecha"
/*
function validarFormatoFecha(textoFecha) {
  // comparar con el formato ISO YYYY-MM-DD
    var RegExPattern = /^\d{2,4}\-\d{1,2}\-\d{1,2}$/;
    if ((textoFecha.match(RegExPattern)) && (textoFecha != '')) {
        // el formato es correcto
        return true;
    } else {
        // el formato NO es valido
        return false;
    }
}
*/

// ***************************************************************
// funcion para validar que una fecha dada existe
// puede ser una fecha para un futuro o un pasado muy lejano
function validarFecha(fecha) {
    let valido = false;
    let partes = (fecha || '').split('-');
    // los dos (--) son para restar una unidad al mes
    fechaGenerada = new Date(partes[0], --partes[1], partes[2]);

    if (partes.length == 3 && fechaGenerada
    && partes[0] == fechaGenerada.getFullYear()
    && partes[1] == fechaGenerada.getMonth()
    && partes[2] == fechaGenerada.getDate()) {
        valido =  fechaGenerada;
    }
    return valido; // fecha es Inválida
}

// ***************************************************************
// funcion que compara una fecha dada con el tiempo actual y 
// indica si la cantidad de años de "edadLimite" es mayor o menor 
function compararMenorEdad(fecha, edadLimite) {
    // Si la fecha es "falso o null" => return NULL
    if (!fecha || fecha == null) {
        console.log("fecha invalida, saliendo funcion ...");
        return null;
    }

  // variable para saber cuanto son "edadLimite" años en milisec
  edadLimite = 1000 * 60 * 60 * 24 * 365.25 * edadLimite;
    let tNow = new Date();
    let resta = tNow.getTime() - fecha.getTime();

    if (resta < edadLimite) {
        console.log("edad es menor de Edad Limite");
        return true;
    } else {
        console.log("Edad es mayor o igual a Edad Limite");
        return false;
    }
}

// ***************************************************************

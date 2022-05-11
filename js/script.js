
// declaracion para el importacion de codigo JS desde otro archivo JS 
// disponible para ES6
// * esta declaracion es reemplazada por la inclusion del archivo JS en el head del html.
// import myValidaciones from 'validaciones.js';

// declaracion de constantes
  // constante para el color de la pregunta y los iconos de calificacion
  const INTERESES = 'Intereses';
  const APTITUDES = 'Aptitudes';
  // const cPreguntaFondo = 'rgba(230, 230, 230, 0.7)';
  // color que tendra un icono al ser seleccionado
  // mismo color que en la variable CSS "--error-color: rgb(245, 130, 37); "
  const colorFace = 'red';
  // const colorFace = 'rgb(245, 130, 37)';
  // color original de los iconos y las preguntas
  const cFaceFuenteOriginal = 'black';
  const cBorderPreg = 'transparent';
  // color para el marco de las preguntas NO respondidas
  const cBorderPregAdvertencia = 'rgb(245, 130, 37)';

// *****************************************************
// funcion para cambiar la(s) clases CSS de un elemento segun su id 
function clasesCSS(idElemento, clases) {
  document.getElementById(idElemento).className = clases;
}
// *****************************************************
// funcion para alternar el diseño del boton para el login
function mostrarLogin() {
  let boton = document.getElementById("botonLogin");
  if (boton.className == "ancho") {
    boton.className = "ancho boton-fondo";
  } else {
    boton.className = "ancho";
  }
  mostrarFormulario('iniciarSesion', 'usuarioId');
}
// *****************************************************
// Muestra/Oculta un elemento "elemMostrar" y pasa el focus a "elemFocus"
function mostrarFormulario(elemMostrar, elemFocus = false) {
  var element = document.getElementById(elemMostrar);
  // comprobar el valor de la variable "display" del elemento "elemMostrar" para mostrar/ocultar
  if(element.style.display == "none" || element.style.display == '' ) { 
    element.style.display = "block";
    if (elemFocus != false) {
      document.getElementById(elemFocus).focus(); 
    }
    // console.log("esconder " + elemMostrar);
  }
  else
    element.style.display = "none";
    // console.log("mostrar " + elemMostrar);
}

//*******************************************************************
// funcion para la validacion y envio de datos de inicio de sesion desde index.php
function validarLogin(claseModoNormal = '' ) {
  let error = "";
  let usuarioId = document.getElementById('usuarioId');
  usuarioId.value = usuarioId.value.trim();
  let passw = document.getElementById('passw');
  passw.value = passw.value.trim();
  let mensajeError = document.getElementById('verErrorLogin');
  let retorno = false;
  
  // remover la clase "error" del formulario
  usuarioId.className = passw.className = claseModoNormal;
  // si el usuario esta vacio...
  if (usuarioId.value == '') {
    usuarioId.className = claseModoNormal + " error"; 
    error += "El nombre de usuario NO puede ser vacio!<br>";
  }
  // si la contraseña esta vacia....
  if (passw.value == '') {
    passw.className = claseModoNormal + " error";
    error += "La contraseña NO puede ser vacia!"
  }

  // Enviar los datos al servidor o Mostrar mensaje con errores
  if(error == "") {
    mensajeError.className = '';
    mensajeError.innerHTML = '';
    // x = document.getElementById('formLogin');
    // x.submit();
    console.log("envio aceptado");
    retorno = true;
  } else {
    mensajeError.innerHTML = error;
    mensajeError.className = "errores";
    console.log("envio fallido");
    retorno = false;
  }
  return retorno;
}

//*******************************************************************
// funcion onMouseOver pregunta + respuesta -> cambia atributos al paso del mouse
// se utiliza CSS para cambiar el background del contenedor de la pregunta y las respuestas

// funcion click respuesta -> marca la pregunta y la respuesta
function selPreguntaResp(elemento) {
  // encontrar al abuelo para poder aplicar los cambios de estilos
  padre = elemento.parentNode;
  abuelo = padre.parentNode;
  // inicializar las clases CSS del elemento de nuevo
  abuelo.className = 'bloque seleccion-respuesta clearfix';
  // abuelo.style.backgroundColor = cPreguntaFondo;
  // abuelo.style.fontStyle= "italic";
  
  // limpiar color de seleccion de los emojis 
  elem = padre.firstElementChild;
  while(elem != null)
  {
    //console.log(elem);
    elem.style.color = cFaceFuenteOriginal;
    elem = elem.nextElementSibling;
  };

  // aplicar color de seleccion al emoji seleccionado
  elemento.style.color = colorFace;
}

//*******************************************************************
// funcion para la validacion y conteo de las respuestas
function validarRespuestas(idFormulario) {
  let respuestasCompletas = true;
  let contador = 0;

  formulario = document.getElementById(idFormulario);
  hijo = formulario.firstElementChild;
  while(hijo != null && hijo.id != "" ) {
    let i = 1;
    let marcado = false;
    // remover la "P" del id de los contenedores DIV
    id = (hijo.id.substr(1));

    // revisar que icono fue marcado
    while( i < 6 && !marcado)
    {
      icono = document.getElementById((id + '.' + i));
      if(icono.style.color == colorFace) {
        marcado = true;
        continue;
      }
      i++;
    }

    // averiguar cual fue el icono seleccionado o mostrar mensaje si no hay seleccion
    if( i < 6 || marcado ) {
      // encontrar el input:hidden y colocar el valor de la respuesta
      y = document.getElementById(id);
      y.value = (i - 1);
      respuestasCompletas = (respuestasCompletas && true);
    } else {  // pregunta NO respondida
      //console.log("Sin respuesta id=" + hijo.id);
      hijo.className = 'bloque preg-sin-seleccion clearfix';
      respuestasCompletas = (respuestasCompletas && false);
    }
    hijo = hijo.nextElementSibling;
    contador++;
  }

  if (!respuestasCompletas) {
    alert('Faltan preguntas por responder');
    return false;
  }
  //alert('Enviando cuestionario');
  // x = document.getElementById(idFormulario);
  // x.submit();
  return true;
}

//*******************************************************************
// funcion para conocer el ancho o alto del area de cliente disponible segun el tamaño de la ventana
function getWindowSize(direccion) {
  var valor = 0;
  if (direccion == 'h') {
    valor = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  }
  else if (direccion == 'v') {
    valor  = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
  }
  else {
    return false;
  }
  return valor;
}

//*******************************************************************
// calcula el ancho o alto disponible y ajusta las dimensiones del contenido 
// para que una pagina pequeña se vea mejor basada en el tamaño de fuente del documento
function altoContenedor() {
  var sizeContenedor = getWindowSize('v');
  if (sizeContenedor == false) {
    return;
  } else {
    var elemento = document.getElementById('area');
    // console.log(document.getElementsByTagName('body'));
    // console.log(document.getElementById('area').style.fontSize);
    // tamaño de la fuente actualmente
    var sizeFuente = '16';
      // el tamaño de la vista menos el alto del header y del footer
    sizeContenedor = (sizeContenedor - (16*5.3) - (16*4));
    elemento.style.minHeight = (sizeContenedor + "px");
    // console.log("Tamaño cliente Vertical: " + elemento.style.minHeight );
    // console.log("Tamaño cliente Horizontal: " + getWindowSize('h') + " px");
  }
}

// ***************************************************************
// ****************** VALIDACIONES DE CAMPOS *********************
// ***************************************************************
// funcion para usar con el evento "onblur" y validar el ID de usuario
function validarIdUsuarioEvento (id) {
  let elemId = document.getElementById(id);
  let x = validarUserID(elemId.value);
  if (x == false) {
    elemId.className = "ancho";
  } else {
    elemId.className = "ancho error";
  }
}

// ***************************************************************
// funcion para usar con el evento "onblur" y checkear las contraseñas
function checkPass() {
  let p1 = document.getElementById('password');
  let p2 = document.getElementById('password2');
  let error = validarPasswords(p1.value, p2.value);
  if (error != false) {
    p1.className = p2.className = "ancho error";
  } else {
    p1.className = p2.className = "ancho";
  }
}

//******************************************************************* 
// funcion para usar con el evento "onblur" y validar los textos 
// en el 2do parametro se puede indicar una clase CSS a ser aplicada en caso que NO haya error
// si el 3er parametro se coloca a true => permite que "" sea aceptado
function validarTextos(id, claseModoNormal = "", permitirBlanco = false) {
  let elemId = document.getElementById(id);
  //console.log("valor de X: " + x);
  if (permitirBlanco && elemId.value == "") {
    return false;
  }
  let x = validarNombre_Apellido(elemId.value);
  if (x == false) {
    elemId.className = claseModoNormal;
  } else {
    elemId.className = claseModoNormal + " error";
  }
  //console.log(elemId)
}

// ***************************************************************
// funcion para usar con el evento "onblur" y validar la fecha
function validarEventoFecha(id, claseModoNormal = '') {
  let elemId = document.getElementById(id);
  // si "validarFecha" se pasa cadena = "" => Error(false)!
  let x = validarFecha(elemId.value);
  //console.log("ValidarEventoFecha = " + x);
  if (x == false) {
    elemId.className = claseModoNormal + " error";
  } else {
    elemId.className = claseModoNormal;
  }
}

//******************************************************************* 
// funcion para usar con el evento "onblur" y validar solo numeros para el telefono 
// si el segundo parametro se coloca a true => permite que "" sea aceptado
// en el 3er parametro se puede indicar una clase CSS a ser aplicada en caso que NO haya error
function validarNumerosTel(id, claseModoNormal = "", permitirBlanco = false) {
  let elemId = document.getElementById(id);
  if (permitirBlanco && elemId.value == "") {
    return false;
  }
  let x = validarTelefono(elemId.value);
  if (x == false) {
    elemId.className = claseModoNormal;
  } else {
    elemId.className = claseModoNormal + " error";
  }
}

//******************************************************************* 
// funcion para usar con "onblur" y saber si el email tiene un formato incorrecto
// en el 3er parametro se puede indicar una clase CSS a ser aplicada en caso que NO haya error
function validarEmailFormulario(id, claseModoNormal = '') {
  let elemId = document.getElementById(id);
  let x = validarEmail(elemId.value);
  if (x == false) {
    elemId.className = claseModoNormal;
  } else {
    elemId.className = claseModoNormal + " error";
  }
}

// *************************************************************************
// funcion para la verificacion de los datos de registro de un nuevo usuario
function validarNuevoUsuario(claseModoNormal = '') {
  // variable para indicar que existen errores en la validacion
  let errorValidar = "";
  let formulario = document.getElementById('formNuevoUsuario');
  let mensajeError = document.getElementById('errorRegistro');

  // elementos "impresindibles" a ser validados
  let validar = ['usuarioId', 'password', 'password2', 'nombre', 'apellido1', 'apellido2', 'nacimiento', 'telefono'];
  
  let elementos = new Array();
  elementos.push(document.getElementById('usuarioId'));
  elementos.push(document.getElementById('password'));
  elementos.push(document.getElementById('password2'));
  elementos.push(document.getElementById('nombre'));
  elementos.push(document.getElementById('apellido1'));
  elementos.push(document.getElementById('apellido2'));
  elementos.push(document.getElementById('nacimiento'));
  elementos.push(document.getElementById('telefono'));
  elementos.push(document.getElementById('email'));
  
  //console.log("Errores: " + errorValidar);
  
  // remover la clase "error" de todos los elementos antes de la comprobacion
  elementos.forEach(element => {
    element.className = claseModoNormal;
  });

  //verificaciones en cada uno de los elementos
  elementos.forEach(element => {
    element.value = element.value.trim();
    switch (element.id) {
      case 'usuarioId':
        x = validarUserID(element.value);  
        if (x == false) {
          element.className = claseModoNormal;
        } else {
          element.className = claseModoNormal + " error";
          errorValidar += x; 
        }
        break;
      case 'password':
      case 'password2': 
        x = validarPasswords(document.getElementById('password').value, document.getElementById('password2').value);
        if (x != false) {
          document.getElementById('password').className = claseModoNormal + " error";
          document.getElementById('password2').className = claseModoNormal + " error";
          errorValidar += x;
        }
        break;
      case ('nombre'):
        if (element.value == "") {
          element.className = claseModoNormal + " error";
          errorValidar += "\"Nombre\" no puede ser vacio.<br />";  
        } else {
          x = validarNombre_Apellido(element.value);
          if (x != false) {
            element.className = claseModoNormal + " error";
            errorValidar += "\"Nombre\" " + x;  
          }
        }
        break;
      case ('apellido1'):
        if (element.value == "") {
          element.className = claseModoNormal + " error";
          errorValidar += "\"Primer Apellido\" no puede ser vacio.<br />";  
        } else {
          x = validarNombre_Apellido(element.value);
          if (x != false) {
            element.className = claseModoNormal + " error";
            errorValidar += "\"Primer Apellido\" " + x;  
          }
        }
        break;
      case ('apellido2'):
        if (element.value == "") {
          element.className = claseModoNormal + " error";
          errorValidar += "\"Segundo Apellido\" no puede ser vacio.<br />";  
        } else {
          x = validarNombre_Apellido(element.value);
          if (x != false) {
            element.className = claseModoNormal + " error";
            errorValidar += "\"Segundo Apellido\" " + x;  
          }
        }
        break;
      case ('telefono'):
        if (element.value == "") {
          element.className = claseModoNormal + " error";
          errorValidar += "Debe ingresar un número de Teléfono.<br />";  
        } else {
          x = validarTelefono(element.value);
          if (x != false) {
            element.className = claseModoNormal + " error";
            errorValidar += x; //"El \"Telefono\" solo se permiten numeros del 0-9, signo (+) y guion (-)<br />";  
          }
        }
        break;
      case 'nacimiento':
        let fecha = validarFecha(element.value);
        if (fecha == false) {
          element.className = claseModoNormal + " error";
          errorValidar += "La fecha no es válida.<br />";
        } else {
          // validar si es mayor de 16 y menor de 70 años
          let menorEdad = compararMenorEdad(fecha, 16);
          let menor70 = compararMenorEdad(fecha, 70);
          if (menorEdad == null || menor70 == null) {
            element.className = claseModoNormal + " error";
            errorValidar += "La fecha no es válida, por favor revisala.<br />";
          } else if (menorEdad == true) {
            element.className = claseModoNormal + " error";
            errorValidar += "Debe ser mayor de 16 años para realizar esta prueba.<br />";
          } else if (menor70 == false) {
            element.className = claseModoNormal + " error";
            errorValidar += "Si es mayor de 70 años, por favor consulte con su asesor.<br />";
          }
        }
        break;
      case 'email':
        x = validarEmail(element.value);
        if (x != false) {
          element.className = claseModoNormal + " error";
          errorValidar += x;
        }
        break;
      default:
        errorValidar += "Error inesperado.<br />";  
        break;
    }
    // console.log("*********************");
    // console.log(element.className);
    // console.log(element.id + " - " + element.value);
    // console.log(errorValidar);
  });

  // verificar si hubo algun error en la validacion. Sino entonces enviar la forma al servidor.
  if(errorValidar == "") {
    mensajeError.innerHTML = errorValidar;
    mensajeError.className = "";
    console.log("enviando formulario!!");
    // formulario.submit();
    return true;
  } else {
    // cancelar el submit y corregir los errores
    mensajeError.innerHTML = errorValidar;
    mensajeError.className = "errores";
    // formulario.submit();  // override comprobaciones
    return true; // override comprobaciones
    // return false; // ejecutar comprobaciones
  }
}

//******************************************************************* 
// funcion para mostrar/ocultar cuadro con categorias en pagina de resultados Generales.
function mostrarCategoriasGeneral() {
  return;
  let catInt = document.getElementById('catIntereses');
  let catApt = document.getElementById('catAptitudes');
  if (catInt.style.display == 'none' || catInt.style.display == '') {
    catInt.style.display = catApt.style.display = 'block';
  } else {
    catInt.style.display = catApt.style.display = 'none';
  }
}

//******************************************************************* 
// funcion que remueve el marco y relleno rojo del campo seleccionado
function limpiarError(elemId) {
  console.log("limpiar error: " + elemId);
  document.getElementById(elemId).className = "";
}

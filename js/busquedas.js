//******************************************************************* 
//******************************************************************* 
// Script para hacer las validaciones de la seccion de busquedas para 
// el tipo de usuario PSICOLOGO
//******************************************************************* 
//******************************************************************* 

// Funcion para impiar el formulario de busqueda de valores previos
function limpiarFormulario() 
{
    let resultados = document.getElementById("resultados");
    resultados.innerText = "";
    resultados.classList.remove("errores");

    let elementos = document.getElementsByTagName("INPUT");
    for (let index = 0; index < elementos.length; index++) {
        if (elementos[index].type == "text" || elementos[index].type == "date") {
            elementos[index].value = "";
        } 
    }
    document.getElementById("noFecha").checked = true;
}

//******************************************************************* 
// funcion para habilitar/deshabilitar los imputs de fechas en la pagina
// "admin/index.view.php"
function activarFechas(visible) {

    // debugger; // validarEventoFecha
    let cuadroFechas = document.getElementById("contenedorFecha");
    let fDesde = document.getElementById('fechaDesde');
    let fHasta = document.getElementById('fechaHasta');

    if (visible) {
        console.log("Visible true");
        cuadroFechas.className = "";
        fDesde.disabled = false;
        fHasta.disabled = false;
    } else {
        console.log("visible false");
        cuadroFechas.className = "contenedor-fecha";
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


// *************************************************************************
// funcion para verificar el texto de un input y cambiar la clase segun el estado
// tener encuenta que si esta en modo edicion se debe poner una clase, ("")
// si esta en modo solo lectura se debe poner otra clase (.desactivado)

// funcion para usar con el evento "onblur" y validar los textos 
// si el segundo parametro se coloca a true => permite que "" sea aceptado
// en el 3er parametro se puede indicar una clase CSS a ser aplicada en caso que NO haya error
function validarTextosEdicion(id, permitirEspacio) {
    console.log("En Validar Textos Edicion.... ", id);
    // Si modoEdicion es true => en edicion, sino es readOnly
    if (modoEdicion) {
        validarTextos(id, permitirEspacio, 'ancho');
    } else {
        validarTextos(id, permitirEspacio, ' desactivado');
    }
}

function validarNumerosTelEdicion(id, permitirEspacio) {
    console.log("En Validar Numeros Tel Edicion");
    // Si modoEdicion es true => en edicion, sino es readOnly
    if (modoEdicion) {
        validarNumerosTel(id, permitirEspacio, 'ancho ');
    } else {
        validarNumerosTel(id, permitirEspacio, 'desactivado');
    }
}

function validarEmailFormularioEdicion(id) {
  // Si modoEdicion es true => en edicion, sino es readOnly
    if (modoEdicion) {
        validarEmailFormulario(id, 'ancho ');
    } else {
        validarEmailFormulario(id, 'desactivado');
    }
}





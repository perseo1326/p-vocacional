

let bCancelarPrueba         = document.getElementById('bCancelarPrueba');
let bEnviarPrueba           = document.getElementById('bEnviarPrueba');
let formPreguntas           = document.getElementById('formPreguntas');
// panel con TODAS las pregunas
let pPreguntas              = document.getElementById('preguntas');

//*******************************************************************
function preguntaSinSeleccion(pregunta) {
    pregunta.classList.add('preg-sin-seleccion');
}

//*******************************************************************
function marcarRespuesta(elemento, padre, abuelo) {

    // modificar las clases CSS para la parte visual
    abuelo.classList.remove('preg-sin-seleccion');
    abuelo.classList.add('preg-con-seleccion');

    // inicializar todos los iconos de la pregunta para borrar selecciones previas
    for (let i = 0; i < padre.childElementCount; i++) {
        const hijo = padre.children[i];
        hijo.classList.remove("respuesta-seleccionada");
    }
    
    // Mostrar la respuesta del usuario
    elemento.classList.add('respuesta-seleccionada');    
}

//*******************************************************************
// funcion para seleccionar e identificar cual ha sido la respuesta seleccionada
function registrarRespuesta(elemento) {
    if (elemento.classList.contains('far')) {
        let padre   = elemento.parentElement;
        let abuelo  = elemento.parentElement.parentElement;
        let valor   = padre.getElementsByTagName("input");

        marcarRespuesta(elemento, padre, abuelo);
        valor[0].value = elemento.dataset['respuesta'];
        console.log("tag name: ", valor[0].value);
    }
}

//*******************************************************************
function validarRespuestas() {
    console.log("panel de preguntas: ");
    console.log(pPreguntas);

    let respuestasCompletas = true;
    for (let i = 0; i < pPreguntas.childElementCount; i++) {
        const pregunta = pPreguntas.children[i];

        // console.log("Pregunta ", pregunta.getElementsByTagName('input')[0].value);

        switch (pregunta.getElementsByTagName('input')[0].value) {
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
                respuestasCompletas = (respuestasCompletas && true);
                break;
            default:
                preguntaSinSeleccion(pregunta);
                respuestasCompletas = (respuestasCompletas && false);
                break;
        }
    }
    return respuestasCompletas;
}

//*******************************************************************
bCancelarPrueba.onclick = function () {
    window.location.href = HOST + 'bienvenida-prueba.php';
}

//*******************************************************************
formPreguntas.onsubmit = function (evento) {
    
    if (validarRespuestas()) {
        console.log("enviando formulario");
        // TODO -> quitar comentario para evitar envio de formulario
        // evento.preventDefault();
    } else {        
        alert('Faltan preguntas por responder');
        evento.preventDefault();
    }
}

//*******************************************************************
pPreguntas.onclick = function (evento) {
    registrarRespuesta(evento.target);
}


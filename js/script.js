
const EDAD_MIN          = 18;
let altoContenido       = document.getElementById("contenido");

//*******************************************************************
// calcula el ancho o alto disponible y ajusta las dimensiones del contenido 
function getContenidoAlto () {
    let altoAreaCliente = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    let altoNavbar      = document.getElementById("navbar").clientHeight;
    let altoFooter      = document.getElementById("footer").clientHeight;
    let altoContenido   = altoAreaCliente - altoNavbar - altoFooter;
    return altoContenido; 
}

//*******************************************************************
const removerErrores = function () {
    pErrorRegistro.innerHTML = "";
    pErrorRegistro.classList.remove("errores");
}

//*******************************************************************
const mostrarErrores = function(elemento, error, nombreDato = '') 
{
	if (error === false) {
		// No hay errores en el usuario ID
		elemento.classList.remove("errores");
        removerErrores();
	} else {
		elemento.classList.add("errores");
		pErrorRegistro.innerHTML = nombreDato + error;
		pErrorRegistro.classList.add("errores");
	}
	console.log("mostrarErrores() -> Elemento: ", elemento, nombreDato + error);
}

//*******************************************************************

window.onload = window.onresize = function () {
    altoContenido.style.minHeight = (getContenidoAlto()) + "px";
}

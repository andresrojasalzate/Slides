const formularioPresentacion = document.getElementById("crearPresentacion");
/**
 * Funcion que muestra los errores que se han encontrado al validar el formulario de Crear Presentacion
 * @param {Array} errores 
 */
function mostrarErrores(errores){

    for (let clave in errores) {
        let contenedorError;

        switch(clave){
            case "nombre":
                contenedorError = document.getElementById("errNombre");  
                break;
            case "descripcion":
                contenedorError = document.getElementById("errDescripcion");
                break;
            case "estilo":
                contenedorError = document.getElementById("errEstilo");
                break;
            case "pin":
                contenedorError = document.getElementById("errPin")
                break;;
        }
        
        while (contenedorError.firstChild) {
            contenedorError.removeChild(contenedorError.firstChild);  
        } 

        let errorAMostar = document.createElement("p");
        errorAMostar.textContent = errores[clave];
        contenedorError.appendChild(errorAMostar);
       }
    }

 /**
 * Funcion que valida los datos del formulario de crear Presentacion
 */
formularioPresentacion.addEventListener('submit', function (e) {
    e.preventDefault();

    let nombre = document.getElementById("nombre").value;
    let descripcion = document.getElementById("descripcion").value;
    let idEstilo = document.getElementById("id_estilo").value;
    let pin = document.getElementById("pin").value;
    let repPin = document.getElementById("rep_pin").value;
    let errores = {}

    if(nombre === ""){

        errores["nombre"] = "El campo \"Titulo\" no puede estar vacío";
       
    }

    if(nombre.length > 255){
        errores["nombre"] = "El campo \"Titulo\" no puede tener más de 255 caracteres";
        
    }
    

    if(descripcion.length > 255){

        errores["descripcion"] = "El campo \"Descripción\"  no puede tener más de 255 caracteres";
        
    }

    if(pin !== repPin){

        errores["pin"] = "Los PINS no coinciden";
    }

    if(pin.length > 50){
        errores["pin"] = "El PIN no puede tener más de 50 caracteres";
    }

    if(isNaN(idEstilo)){

        errores['estilo'] = "Ha habido un error al seleccionar el estilo. Vuelva a intentarlo"
    }

    if(Object.keys(errores).length > 0){
       
        mostrarErrores(errores)

    }else{
        
        this.submit();
    }

   
});

const slider = document.querySelector(".slider");
const slides = document.querySelectorAll(".slider li");
const inputIDEstilo = document.getElementById("id_estilo");
let currentSlide = 0;

let estiloId = slides[currentSlide].getAttribute("data");
inputIDEstilo.value = estiloId;


function mostrarSlide(slideIndex) {
    slides[currentSlide].style.display = "none";
    currentSlide = (slideIndex + slides.length) % slides.length;
    console.log(currentSlide)
    slides[currentSlide].style.display = "block";

    let estiloId = slides[currentSlide].getAttribute("data");
    inputIDEstilo.value = estiloId;

}
function avanzarSlide() {
    mostrarSlide(currentSlide + 1);
  }
  
  function retrocederSlide() {
    mostrarSlide(currentSlide - 1);
  }
  
  document.getElementById("siguiente").addEventListener("click", avanzarSlide);
  document.getElementById("anterior").addEventListener("click", retrocederSlide);


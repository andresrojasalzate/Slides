const formularioPresentacion = document.getElementById("crearPresentacion");
/**
 * Funcion que muestra los errores que se han encontrado al validar el formulario de Crear Presentacion
 * @param {Array} errores 
 */
function mostrarErrores(errores){

    for (let clave in errores) {
        let contenedorError;
        if(clave === "nombre"){

            contenedorError = document.getElementById("errNombre");
        }else{
            contenedorError = document.getElementById("errDescripcion");
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

    if(Object.keys(errores).length > 0){
       
        mostrarErrores(errores)

    }else{
        this.submit();
    }

   
});


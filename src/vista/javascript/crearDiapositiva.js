const tipoDiapositiva = document.querySelectorAll('input[type="radio"]');
const divContenido = document.querySelector('.divOculto');

tipoDiapositiva.forEach(element => {
    element.addEventListener('click',function(){
        if(element.value === 'contenido'){
            divContenido.style.display = 'flex';
        }
        else{
            divContenido.style.display = 'none';
            contenidoDiapo.value = "";
        }
    })
});


const formularioDiapositiva = document.getElementById("crearDiapositiva");

function mostrarErrores(errores){

    for (let clave in errores) {
        let contenedorError;
        if(clave === "titulo"){

            contenedorError = document.getElementById("errNombre");
        }else{
            contenedorError = document.getElementById("errDescripcion");
        }
         
        contenedorError.removeChild(contenedorError.firstChild);
        let errorAMostar = document.createElement("p");
        errorAMostar.textContent = errores[clave];
        contenedorError.appendChild(errorAMostar);
       }
    }

    

formularioDiapositiva.addEventListener('submit', function (e) {
    e.preventDefault();

    let titulo = document.getElementById("tituloDiapo").value;
    let descripcion = document.getElementById("contenidoDiapo").value;
    let errores = {}

    if(titulo === ""){

        errores["titulo"] = "El campo \"Titulo\" no puede estar vacío";
       
    }

    if(titulo.length > 255){
        errores["titulo"] = "El campo \"Titulo\" no puede tener más de 255 caracteres";
        
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




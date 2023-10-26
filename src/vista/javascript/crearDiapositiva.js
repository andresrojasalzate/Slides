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

document.addEventListener('DOMContentLoaded', function() {

    const contDiapo = document.querySelector('.contDiapo');

    if (contDiapo && contDiapo.checked) {
    divContenido.style.display = 'flex';
    console.log("funciona");
}

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



function verDiapositiva() {
    let a;
    const tituloDiapo = document.getElementById("tituloDiapo").value;
    const contenidoDiapo = document.getElementById("contenidoDiapo").value;
    const tipoDiapo = document.querySelector('input[type="radio"]:checked').value;

    if (tipoDiapo === 'contenido') {
        a = [
            {
            "titulo": tituloDiapo,
            "contenido": contenidoDiapo,
            "tipoDiapositiva": tipoDiapo,
            "nDiapositiva": 1
        }
    ];
    } else {
        a = [
            {
            "titulo": tituloDiapo,
            "contenido": "",
            "tipoDiapositiva": "titulo",
            "nDiapositiva": 1
            }
        ];
    }

    document.cookie = "1diapo=" + true;
    document.cookie = "arrayDiapositivas=" + JSON.stringify(a);
    window.location.href = "visualizarDiapositiva.php";
}

document.addEventListener('DOMContentLoaded', function() {
    // Este código se ejecuta cuando la página se carga
    const toast = document.getElementById('toast');
    if (toast) {
        toast.style.display = 'block'; // Muestra el toast
        setTimeout(function() {
            toast.style.display = 'none'; // Oculta el toast después de 3 segundos
        }, 3000);
    }
});

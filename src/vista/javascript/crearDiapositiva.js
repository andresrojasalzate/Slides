const tipoDiapositiva = document.querySelectorAll('input[type="radio"]');
const divContenido = document.querySelector('.divOculto');
const divImg = document.querySelector('.imgOculto');
const formularioDiapositiva = document.getElementById("crearDiapositiva");

tipoDiapositiva.forEach(element => {
    element.addEventListener('click', function () {
        if (element.value === 'contenido') {
            divImg.style.display = 'none';
            divContenido.style.display = 'flex';
        } else if (element.value === 'imagen') {
            divContenido.style.display = 'none';
            divImg.style.display = 'flex';
        }
        else {
            divImg.style.display = 'none';
            divContenido.style.display = 'none';
            contenidoDiapo.value = "";
        }
    })
});

document.addEventListener('DOMContentLoaded', function () {

    const contDiapo = document.querySelector('.contDiapo');
    const imgDiapo = document.querySelector('.imgDiapo');

    if (contDiapo && contDiapo.checked) {
        divContenido.style.display = 'flex';
    }
    if (imgDiapo && imgDiapo.checked) {
        divImg.style.display = 'flex';
    }

});

const mostrarErrores = (errores) =>{
    for (let clave in errores) {
        let contenedorError;
        if (clave === "titulo") {

            contenedorError = document.getElementById("errNombre");
        } else {
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

    if (titulo === "") {

        errores["titulo"] = "El campo \"Titulo\" no puede estar vacío";

    }

    if (titulo.length > 255) {
        errores["titulo"] = "El campo \"Titulo\" no puede tener más de 255 caracteres";

    }


    if (descripcion.length > 255) {

        errores["descripcion"] = "El campo \"Descripción\"  no puede tener más de 255 caracteres";

    }

    if (Object.keys(errores).length > 0) {

        mostrarErrores(errores)

    } else {
        this.submit();
    }
});



const verDiapositiva = () => {
    let diapo;
    const tituloDiapo = document.getElementById("tituloDiapo").value;
    const contenidoDiapo = document.getElementById("contenidoDiapo").value;
    const tipoDiapo = document.querySelector('input[type="radio"]:checked').value;
    const presentaciones_id = document.getElementById("presentaciones_id").value;
    const contenidoDiapoImg = document.getElementById("contenidoDiapoImg").value;

    if (tipoDiapo === 'contenido') {
        diapo = [
            {
                "titulo": tituloDiapo,
                "contenido": contenidoDiapo,
                "tipoDiapositiva": tipoDiapo,
                "presentaciones_id": presentaciones_id,
                "imagen": "",
                "nDiapositiva": 1
            }
        ];
    } else if (tipoDiapo == 'titulo') {
        diapo = [
            {
                "titulo": tituloDiapo,
                "contenido": "",
                "tipoDiapositiva": tipoDiapo,
                "presentaciones_id": presentaciones_id,
                "imagen": "",
                "nDiapositiva": 1
            }
        ];
    } else {
        diapo = [
            {
                "titulo": tituloDiapo,
                "contenido": contenidoDiapoImg,
                "tipoDiapositiva": tipoDiapo,
                "presentaciones_id": presentaciones_id,
                "imagen": "",
                "nDiapositiva": 1
            }
        ];
    }

    document.cookie = "1diapo=" + 'crearDiapo';
    document.cookie = "arrayDiapositivas=" + JSON.stringify(diapo);
    window.location.href = "visualizarDiapositiva.php";
}

document.addEventListener('DOMContentLoaded', function () {
    // Este código se ejecuta cuando la página se carga
    const toast = document.getElementById('toast');
    if (toast) {
        toast.style.display = 'block'; // Muestra el toast
        setTimeout(function () {
            toast.style.display = 'none'; // Oculta el toast después de 3 segundos
        }, 3000);
    }
});

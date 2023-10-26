const btnVolver = document.querySelector('[name="btnVolver"]');
const btnNuevaDiapositiva = document.querySelector('[name="btnNuevaDiapositiva"]');

btnNuevaDiapositiva.addEventListener('click', function () {
    const posicion = btnNuevaDiapositiva.value;
    document.cookie = "id_ultima_presentacion=" + posicion;
    window.location.href = "crearDiapositiva.php";
});

// funcion volver a pantalla home
btnVolver.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.href = "home.php";
})

// funcion redirigir a nueva diapositiva
btnNuevaDiapositiva.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.href = "crearDiapositiva.php";
})

//mostrar modal de confirmación antes de eliminar una presentación
const contenedorDiapositivas = document.querySelector('.contenedorDiapositivas');
const confirmacionEliminar = document.querySelector('.fondoModalEliminarDiapositiva');
const feedback = document.querySelector('.fondoModalFeedBackEliminarDiapositiva');
const btnAceptar = document.querySelector('[name="btnAceptar"]');
const btnCancelar = document.querySelector('[name="btnCancelar"]');
const modalEliminarDiapositiva = document.querySelector('.modalEliminarDiapositiva');
const modalFeedBackEliminarDiapositiva = document.querySelector('.modalFeedBackEliminarDiapositiva');



contenedorDiapositivas.addEventListener('click', function (e) {
    if (e.target.name === "btnDelDiapositiva") {
        console.log(e.target.value);
        confirmacionEliminar.style.display = "block";
        btnAceptar.value = e.target.value;
    }
})

//ocultar modal de confirmacion de la eliminacion de presentaciones
const ocultarModales = () => {
    confirmacionEliminar.style.display = "none";
    feedback.style.display = "none";
}

modalEliminarDiapositiva.addEventListener('click', function (e) {
    if (e.target.name === "btnCancelar") {
        ocultarModales();
    }
})

// aceptar y volver a la pantalla presentaciones
modalEliminarDiapositiva.addEventListener('click', function (e) {
    if (e.target.name === "btnAceptar") {
        ocultarModales();
        feedback.style.display = "block";
    }
})

if (modalFeedBackEliminarDiapositiva != null) {
    modalFeedBackEliminarDiapositiva.addEventListener('click', function (e) {
        if (e.target.name === "btnCerrar") {
            ocultarModales();
        }
    })
}

//Reordenamiento de diapositivas

const diapositivas = document.querySelectorAll('.presentacionBD');
const formulario = document.querySelector('form');
let ordenNuevoDiapositivas = null;





const idsDiapositivas = (arrayDiapositivas) =>{
    const arrayValueDiapositivas =[];
    arrayDiapositivas.forEach(element => {
        arrayValueDiapositivas.push(element.id);
    });
    return arrayValueDiapositivas;
}

const crearElemento = (ordenDiapositivas,nombre) =>{
    const input = document.createElement('input');
    const nuevoOrden = JSON.stringify(ordenDiapositivas);
    input.setAttribute("type", "hidden");
    input.setAttribute("name", nombre);
    input.setAttribute("value", nuevoOrden);
    formulario.appendChild(input);
}

let ordenOriginalDiapositivas = idsDiapositivas(diapositivas);
crearElemento(ordenOriginalDiapositivas,"ordenOriginalDiapositivas");


const dragStart = (e) => {
    console.log('dragstart');
    // Transferim l'id de l'element que arroseguem:
    e.dataTransfer.setData('text', e.target.id);
    e.dropEffect = 'linkMove';
    setTimeout(() => e.target.classList.add('invisible'), 0);
    e.target.opacity = .5;
    console.log(diapositivas);
}

const dragEnd = (e) => {
    console.log('dragend');
    e.target.classList.remove('invisible');
}

diapositivas.forEach(diapositiva => {
    diapositiva.addEventListener('dragstart', dragStart);
});


const dragOver = (e) => {
    e.preventDefault();
    e.target.opacity = .5;
};

const drop = (e) => {
    e.preventDefault();
    console.log('drop');
    // Obtenim l'id de l'element arrossegat:
    const idDiapositiva = e.dataTransfer.getData("text");
    const nuevaUbicacion = document.getElementById(idDiapositiva);
    e.target.appendChild(document.getElementById(idDiapositiva));
    nuevaUbicacion.classList.remove('invisible');
    nuevaUbicacion.opacity = '';
    const nuevoArray = document.querySelectorAll('.presentacionBD');
    //console.log(nuevoArray);
    ordenNuevoDiapositivas = idsDiapositivas(nuevoArray);
    crearElemento(ordenNuevoDiapositivas,"ordenNuevoDiapositivas");
};

contenedorDiapositivas.addEventListener('dragover', dragOver);
contenedorDiapositivas.addEventListener('drop', drop);

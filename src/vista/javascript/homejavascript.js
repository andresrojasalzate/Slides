document.addEventListener('DOMContentLoaded', function() {
    const botones = document.querySelectorAll('.boton');
    
    botones.forEach(function(boton) {
        boton.addEventListener('click', function() {
            const posicion = boton.getAttribute('data-position');
            document.cookie = "id_ultima_presentacion=" + posicion;
            window.location.href = "crearDiapositiva.php";
        });
    });
});


//mostrar modal de confirmación antes de eliminar una presentación
const eventoClicEliminar = document.querySelector('.contentPresentaciones');
const confirmacionEliminar = document.querySelector('.fondoModalEliminarPresentacion');
const feedback = document.querySelector('.fondoModalFeedBackEliminarPresentacion');
const btnAceptar = document.querySelector('[name="btnAceptar"]');
const btnCancelar = document.querySelector('[name="btnCancelar"]');
const modalEliminarPresentacion = document.querySelector('.modalEliminarPresentacion');
const modalFeedBackEliminarPresentacion = document.querySelector('.modalFeedBackEliminarPresentacion');


eventoClicEliminar.addEventListener('click',function(e){
    if(e.target.name === "btnDelPresentacion"){
        confirmacionEliminar.style.display = "block";
        btnAceptar.value = e.target.value;
    }
})

//ocultar modal 
const ocultarModales = () =>{
    confirmacionEliminar.style.display = "none";
    feedback.style.display = "none";
}

modalEliminarPresentacion.addEventListener('click', function(e){
    if(e.target.name === "btnCancelar"){
        ocultarModales();
    }
})

// aceptar y volver a la pantalla presentaciones
modalEliminarPresentacion.addEventListener('click', function(e){
    if(e.target.name === "btnAceptar"){
        ocultarModales();
        feedback.style.display = "block";
    }
})

modalFeedBackEliminarPresentacion.addEventListener('click', function(e){
    if(e.target.name === "btnCerrar"){
        ocultarModales();
        window.location.href = "home.php";
    }
})



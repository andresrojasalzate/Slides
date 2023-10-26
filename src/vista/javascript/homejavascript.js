document.addEventListener('DOMContentLoaded', function() {
    const botones = document.querySelectorAll('.nDiapo');
    
    botones.forEach(function(boton) {
        boton.addEventListener('click', function() {
            const posicion = boton.getAttribute('data-position');
            document.cookie = "id_ultima_presentacion=" + posicion;
            window.location.href = "crearDiapositiva.php";
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const botones = document.querySelectorAll('.vDiapo');
    
    botones.forEach(function(boton) {
        boton.addEventListener('click', function() {
            let diapos = boton.getAttribute('data-position');
            let estilo = boton.getAttribute('estilo');
            if (diapos.length > 2) {
                console.log(diapos);
                document.cookie = "arrayDiapositivas=" + diapos;
                document.cookie = "idEstilo=" + estilo;
                window.location.href = "visualizarDiapositiva.php";
            } else {
                console.error('El valor de diapos es null');
            }
        });
    });
});

//mostrar modal de confirmación antes de eliminar una presentación
const eventoClicBotonesPresentacion = document.querySelector('.contentPresentaciones');
const confirmacionEliminar = document.querySelector('.fondoModalEliminarPresentacion');
const feedback = document.querySelector('.fondoModalFeedBackEliminarPresentacion');
const btnAceptar = document.querySelector('[name="btnAceptar"]');
const btnCancelar = document.querySelector('[name="btnCancelar"]');
const modalEliminarPresentacion = document.querySelector('.modalEliminarPresentacion');
const modalFeedBackEliminarPresentacion = document.querySelector('.modalFeedBackEliminarPresentacion');


eventoClicBotonesPresentacion.addEventListener('click',function(e){
    if(e.target.name === "btnDelPresentacion"){
        confirmacionEliminar.style.display = "block";
        btnAceptar.value = e.target.value;
    }
})

//ocultar modal de confirmacion de la eliminacion de presentaciones
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

if(modalFeedBackEliminarPresentacion!=null){
    modalFeedBackEliminarPresentacion.addEventListener('click', function(e){
        if(e.target.name === "btnCerrar"){
            ocultarModales();
        }
    })
}

// redireccion a la pantalla editar presentaciones
eventoClicBotonesPresentacion.addEventListener('click',function(e){
    if(e.target.name === "btnEditPresentacion"){
        console.log('hola');
        const posicion = e.target.value;
        document.cookie = "id_ultima_presentacion=" + posicion;
        window.location.href = "editarPresentacion.php";
    }
})  


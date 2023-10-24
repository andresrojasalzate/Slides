const btnVolver = document.querySelector('[name="btnVolver"]');
const btnNuevaDiapositiva = document.querySelector('[name="btnNuevaDiapositiva"]');

btnNuevaDiapositiva.addEventListener('click', function() {
    const posicion = btnNuevaDiapositiva.value;
    document.cookie = "id_ultima_presentacion=" + posicion;
    window.location.href = "crearDiapositiva.php";
});

// funcion volver a pantalla home
btnVolver.addEventListener("click",function(e){
    e.preventDefault();
    window.location.href = "home.php";
})

// funcion redirigir a nueva diapositiva
btnNuevaDiapositiva.addEventListener("click",function(e){
    e.preventDefault();
    window.location.href = "crearDiapositiva.php";
})
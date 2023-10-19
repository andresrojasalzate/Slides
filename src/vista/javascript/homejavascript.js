
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


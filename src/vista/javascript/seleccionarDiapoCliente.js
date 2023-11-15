



document.addEventListener('DOMContentLoaded', function() {
    const botones = document.querySelectorAll('.vDiapo');
    
    botones.forEach(function(boton) {
        boton.addEventListener('click', function() {
            let posicion = boton.getAttribute('nDiapo');
                document.cookie = "posicion=" + posicion;
                window.location.href = "vistaCliente.php";
                console.error('El valor de diapos es null');
            
        });
    });
});
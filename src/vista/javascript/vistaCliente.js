const radioButtons = document.querySelectorAll('input[type="radio"]');

radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', function() {
        respuesta = radioButton.getAttribute("value");
        idDiapo = radioButton.getAttribute("name");
        document.cookie = idDiapo + "=" + respuesta;
    });
});
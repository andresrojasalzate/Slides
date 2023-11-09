const radioButtons = document.querySelectorAll('input[type="radio"]');
const idDiapo = radioButtons[0].getAttribute("name");

radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', function() {
        respuesta = radioButton.getAttribute("value");
        document.cookie = idDiapo + "=" + respuesta;
    });
});
console.log(idDiapo);
if (document.cookie.indexOf(idDiapo) !== -1) {

    radioButtons.forEach(radioButton => {
        radioButton.disabled = true;
    });
    
}
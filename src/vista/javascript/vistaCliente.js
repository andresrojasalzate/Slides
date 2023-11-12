const radioButtons = document.querySelectorAll('input[type="radio"]');
const idDiapo = radioButtons[0].getAttribute("name").toString();

const cookieExiste = (nombreCookie) =>{
    let nombre = nombreCookie + "=";
    let cookies = decodeURIComponent(document.cookie);
    let cookieArray = cookies.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
      var cookie = cookieArray[i].trim();
      if (cookie.indexOf(nombre) == 0) {
        return true;
      }
    }
    return false;
}

radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', function() {
        respuesta = radioButton.getAttribute("value");
        document.cookie = idDiapo + "=" + respuesta;
    });
});

document.addEventListener('DOMContentLoaded', function () {

    let resultado = cookieExiste(idDiapo);
    if(resultado) {
        radioButtons.forEach(radioButton => {
        radioButton.disabled = true; 
    }); 
    }
});

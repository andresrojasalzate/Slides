const tipoDiapositiva = document.querySelectorAll('input[type="radio"]');
const divContenido = document.querySelector('.divOculto');

tipoDiapositiva.forEach(element => {
    element.addEventListener('click',function(){
        if(element.value === 'contenido'){
            divContenido.style.display = 'flex';
        }
        else{
            divContenido.style.display = 'none';
        }
    })
});



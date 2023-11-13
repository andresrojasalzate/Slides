const slider = document.querySelector(".slider");
const slides = document.querySelectorAll(".slider li");
const inputIDEstilo = document.getElementById("id_estilo");
let currentSlide = 0;

let estiloId = slides[currentSlide].getAttribute("value");
inputIDEstilo.value = estiloId;

const mostrarSlide = (slideIndex) => {
    slides[currentSlide].style.display = "none";
    currentSlide = (slideIndex + slides.length) % slides.length;
    slides[currentSlide].style.display = "block";

    let estiloId = slides[currentSlide].getAttribute("value");
    inputIDEstilo.value = estiloId;

}
const avanzarSlide = () => {
    mostrarSlide(currentSlide + 1);
}

const retrocederSlide = () => {
    mostrarSlide(currentSlide - 1);
}

document.getElementById("siguiente").addEventListener("click", avanzarSlide);
document.getElementById("anterior").addEventListener("click", retrocederSlide);

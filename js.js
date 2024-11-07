
function revealOnScroll() {
    const reveals = document.querySelectorAll('.content-box');

    for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight;
        const revealTop = reveals[i].getBoundingClientRect().top;
        const revealPoint = 150; 

        if (revealTop < windowHeight - revealPoint) {
            reveals[i].classList.add('show');
        } else {
            reveals[i].classList.remove('show');
        }
    }
}


window.addEventListener('scroll', revealOnScroll);

document.getElementById('menuToggle').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
});
// JavaScript para o botão Back to Top
document.addEventListener("DOMContentLoaded", function () {
    const backToTopButton = document.getElementById("backToTop");

    // Mostrar o botão ao rolar para baixo
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            backToTopButton.classList.add("show");
        } else {
            backToTopButton.classList.remove("show");
        }
    });

    // Rolar suavemente até o topo ao clicar no botão
    backToTopButton.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});

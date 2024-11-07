
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

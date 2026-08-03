/* MENU HAMBURGUESA */
const hamburger = document.getElementById('hamburger');
const navMenu = document.querySelector('.navbar ul');

if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });
}

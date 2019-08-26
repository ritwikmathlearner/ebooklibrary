const navSlide = () => {
    const menuLines = document.querySelector('.menu-lines');
    const navigation = document.querySelector('.nav-link');
    const subNavigation = document.querySelector('.sub-menu');
    const navigationLinks = document.querySelectorAll('.nav-link li a');
    menuLines.addEventListener('click', () => {
        navigation.classList.toggle('navbar-active');
        subNavigation.classList.toggle('sub-navbar-active');
    navigationLinks.forEach((link, index) => {
        if(link.style.animation) {
            link.style.animation = '';
        }
        else {
            link.style.animation = `navigationLinkOpacity 0.5s ease forwards ${index / 7 + .7}s`;
        //console.log(index / 7);
        }
    });
    menuLines.classList.toggle('toggle');
    });
}
navSlide();
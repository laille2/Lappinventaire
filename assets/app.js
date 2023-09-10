/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import 'bootstrap';

document.getElementsByClassName('navbar-brand')[0].addEventListener('click', (e) => {

    let navbarContent = document.getElementById("navbarColor01");
    let navbarClasses = document.getElementsByClassName('navbar')[0].classList;

    if (navbarContent.classList.contains("hidden")) {
        navbarContent.classList.replace("hidden", "navbar-collapse");
        navbarClasses.remove("navbar-minimized");
    } else {
        navbarContent.classList.replace("navbar-collapse", "hidden");
        navbarClasses.add("navbar-minimized");
    }
    console.log(navbarClasses);
});
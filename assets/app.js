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
    if (document.getElementById("navbarColor01").classList.contains("hidden")) {
        document.getElementById("navbarColor01").classList.replace("hidden", "navbar-collapse");
        document.getElementsByClassName('navbar')[0].classList.remove("navbar-minimized");
    } else {
        document.getElementById("navbarColor01").classList.replace("navbar-collapse", "hidden");
        document.getElementsByClassName('navbar')[0].classList.add("navbar-minimized");
    }
    console.log(document.getElementsByClassName('navbar')[0]);
});
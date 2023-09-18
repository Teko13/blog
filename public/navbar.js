// Nav links deployement manage

const deployBtn = document.querySelector(".no-deployed");
const closeBtn = document.querySelector(".deployed");
const navLinks = document.querySelector(".nav__list");

let navLinksDisplay = false;
const navLinksToggle = () => {
    navLinksDisplay = !navLinksDisplay;
    if (navLinksDisplay) {
        navLinks.style.display = "block";
        deployBtn.style.display = "none";
        closeBtn.style.display = "inline";
    } else {
        navLinks.style.display = "none";
        deployBtn.style.display = "inline";
        closeBtn.style.display = "none";
    }
};

deployBtn.addEventListener("click", navLinksToggle);
closeBtn.addEventListener("click", navLinksToggle);

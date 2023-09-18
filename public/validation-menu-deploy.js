// validation menu
const validationMenuLibelle = document.querySelector(".validation-libelle");
const validationArrow = document.querySelector("#validation-menu-arrow");
const validationItems = document.querySelector(".validation-groupe-items");
validationMenuLibelle.addEventListener("click", () => {
    console.log("ok");
    validationItems.classList.contains("visible") ? validationItems.classList.remove("visible") : validationItems.classList.add("visible");
    validationArrow.classList.contains("up") ? validationArrow.classList.remove("up") : validationArrow.classList.add("up");
});

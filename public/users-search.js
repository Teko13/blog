

// users validation search enginne

const searchInput = document.querySelector("#search");
const users = document.querySelectorAll(".user");
console.log(users[0].querySelector("h2"));

searchInput.addEventListener("input", (e) => {
    let textInput = searchInput.value;
    users.forEach(user => {
        if ((user.querySelector("h2").textContent.includes(textInput)) ||
            (user.querySelector("i").textContent.includes(textInput))) {
            user.classList.contains("invisible") ? user.classList.remove("invisible") : "";
        }
        else {
            user.classList.add("invisible");
        }
    });
})


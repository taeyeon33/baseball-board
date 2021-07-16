const log = console.log;

class mainApp {
    constructor() {
        if (window.scrollY > 0) document.querySelector("header").classList.add("scroll");

        this.addEvent();
    }

    addEvent() {
        const logo = document.querySelector("#logo");
        const header = document.querySelector("header");

        logo.addEventListener("click", () => {
            location.href = "/";
        });

        window.addEventListener("scroll", e => {
            if (window.scrollY > 0) {
                header.classList.add("scroll");
            } else {
                header.classList.remove("scroll");
            }
        });
    }
}

window.addEventListener("load", () => {
    let mainapp = new mainApp();
});

window.alertBox = function(msg, bool) {
    document.querySelector(".alertBox").innerHTML = "";

    const div = document.createElement("div");
    div.classList.add("w-75", "mx-auto", "alert");
    if (bool) div.classList.add("alert-success");
    else div.classList.add("alert-danger");
    const alert =
        `${msg}
        <button class="close">&times;</button>`;
    div.innerHTML = alert;
    document.querySelector(".alertBox").append(div);
    setTimeout(() => {
        document.querySelector(".close").addEventListener("click", e => { e.currentTarget.parentElement.remove(); });
    }, 100);
    setTimeout(() => { div.remove(); }, 3000);
}
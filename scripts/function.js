function Darkmode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
    if (element.classList == "dark-mode") {
        document.getElementById("darkmode").src = "images/logoDark.jpg";
        document.getElementById("navbar").style.backgroundColor = "white";
    } else {
        document.getElementById("darkmode").src = "images/logo.jpg";
        document.getElementById("navbar").style.backgroundColor = "#2d2d30";
    }
}


function Darkmode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
    if (element.classList == "dark-mode") {
        document.getElementById("darkmode").src = "logoDark.jpg" ;
        document.getElementById("navbar").style.backgroundColor = "white";
    }else{
        document.getElementById("darkmode").src = "logo.jpg" ;
        document.getElementById("navbar").style.backgroundColor = "#2d2d30";

    }
 }


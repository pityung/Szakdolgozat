

function save_data_to_localstorage(input_id) {
    const input_val = document.getElementById(input_id).value;
    localStorage.setItem(input_id, input_val)   ;
    console.log(input_val);
}

username.addEventListener("keyup", function() {
    save_data_to_localstorage("username");
});
first_name.addEventListener("keyup", function() {
    save_data_to_localstorage("first_name");
});
last_name.addEventListener("keyup", function() {
    save_data_to_localstorage("last_name");
});
phone.addEventListener("keyup", function() {
    save_data_to_localstorage("phone");
});
email.addEventListener("keyup", function() {
    save_data_to_localstorage("email");
});

submit.addEventListener("click", function() {
    save_data_to_localstorage("username");
    save_data_to_localstorage("first_name");
    save_data_to_localstorage("last_name");
    save_data_to_localstorage("phone");
    save_data_to_localstorage("email");
});
function init_values() {
    if (localStorage["username"]) {
        document.getElementById("username").value = localStorage["username"];
    }
    if (localStorage["first_name"]) {
        document.getElementById("first_name").value = localStorage["first_name"];
    }
    if (localStorage["last_name"]) {
        document.getElementById("last_name").value = localStorage["last_name"];
    }
    if (localStorage["phone"]) {
        document.getElementById("phone").value = localStorage["phone"];
    }
    if (localStorage["email"]) {
        document.getElementById("email").value = localStorage["email"];
    }
    if (localStorage["submit"]) {
        document.getElementById("username").value = localStorage["username"];
        document.getElementById("first_name").value = localStorage["first_name"];
        document.getElementById("last_name").value = localStorage["last_name"];
        document.getElementById("phone").value = localStorage["phone"];
        document.getElementById("email").value = localStorage["email"];
    }
}

init_values();
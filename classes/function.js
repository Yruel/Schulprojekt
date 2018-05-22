function ShowLogin() {
    $("#login-modal").modal("toggle");
}
function ShowRegister() {
    $("#register-modal").modal("toggle");
}
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
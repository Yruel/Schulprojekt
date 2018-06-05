function userdata(){
    $.ajax({
        url: "api.php?action=customer",
        dataType: 'json',
        success: function (result) {
            document.getElementById('vorname').setAttribute("value", result.name);
            document.getElementById('nachname').setAttribute("value", result.lastname);
            document.getElementById('straße').setAttribute("value", result.street);
            document.getElementById('housenumber').setAttribute("value", result.housenumber);
            document.getElementById('plz').setAttribute("value", result.postcode);
            document.getElementById('home').setAttribute("value", result.place);
            document.getElementById('email').setAttribute("value", result.mail);
        }
    });
}

$('#buy').on("submit", function (e) {
   swal("Hallo");
});


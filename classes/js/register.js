function register() {
    if (document.getElementById("lastname").value == "") {
        swal("Bitte Nachnamen Eintragen.", "", "warning");
    }
    else if (document.getElementById("name").value == "") {
        swal("Bitte Vornamen Eintragen.", "", "warning");
    }
    else if (document.getElementById("street").value == "") {
        swal("Bitte Straße Eintragen.", "", "warning");
    }
    else if (document.getElementById("house").value == "") {
        swal("Bitte Hausnummer Eintragen.", "", "warning");
    }
    else if (document.getElementById("place").value == "") {
        swal("Bitte Ort Eintragen.", "", "warning");
    }
    else if (document.getElementById("postcode").value == "") {
        swal("Bitte Postleitzahl Eintragen.", "", "warning");
    }
    else if (document.getElementById("mail").value == "") {
        swal("Bitte e-Mail Adresse Eintragen.", "", "warning");
    }
    else if (document.getElementById("password").value == "") {
        swal("Bitte Passwort Eintragen.", "", "warning");
    }
    else if (document.getElementById("passwordTwo").value == "") {
        swal("Bitte Passwort wiederholen.", "", "warning");
    
    } else {
        var x = document.getElementById("gender");
        var salutation = x.options[x.selectedIndex].value;
        var lastname = document.getElementById("lastname").value;
        var name = document.getElementById("name").value;
        var street = document.getElementById("street").value;
        var house = document.getElementById("house").value;
        var place = document.getElementById("place").value;
        var postcode = document.getElementById("postcode").value;
        var mail = document.getElementById("mail").value;
        var password = document.getElementById("password").value;
        var passwordTwo = document.getElementById("passwordTwo").value;

        $.ajax({
            type: "POST",
            url: "api.php?action=register&lastname="+lastname+"&name="+name+"&street="+street+"&house="+house+"&place="+place+"&postcode="+postcode+"&mail="+mail+"&password="+password+"&salutation="+salutation,
            dataType: 'HTML',
            success: function(result) {
                swal("Registrierung erfolgreich!", "", "success")
                .then((value)=>{
                    if (value === true) {
                        window.location.replace = "index.php";
                    } else {
                        window.location.replace = "index.php";
                    }
                });
            },
          });


    }
    
}
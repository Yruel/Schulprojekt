function shopping_delete(id) {
    $.ajax({
        url: "api.php?action=shopping_delete&productid="+id,
        success: function () {
            window.location.replace("index.php?request=shopping_cart");
        }
    })
}
function replace() {
    if(document.getElementById('summe').innerText != "0"){
        window.location.replace('index.php?request=buy')
    }
    else {
        swal("Bitte wählen Sie ein Produkt aus", "", "info");
    }
}
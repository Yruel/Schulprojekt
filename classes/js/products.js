$(document).ready(function (){

    var div = document.getElementById("products");
    var url_string = window.location.href;
    var url = new URL(url_string);
    if (!url.searchParams.get("category")) {
        var category = "sound";
    } else {
        var category = url.searchParams.get("category");
    }

    $.ajax({
        url : "api.php?action=products&category="+category,
        dataType: 'json',
        success : function(result) {
            for(var i = 0; i < result.length; i++){
                div.innerHTML +=
                    "<div onclick='loadProduct("+result[i].ID+");' class='product'>" +
                        "<img src='img/products/"+result[i].ID+".png'>" +
                        "<p>"+result[i].brand+" "+result[i].name+"</p>" +
                    "</div>";
            }
        }
    });
});
function loadProduct(value) {
    $("#productModal").modal("toggle");
    $.ajax({
        url: "api.php?action=product&id="+value,
        dataType: 'json',
        success: function (result) {
            document.getElementById("productLabel").innerText = result.brand+" "+result.name;
            document.getElementById("productImage").setAttribute("src", "img/products/"+result.ID+".png");
            document.getElementById("productPrice").innerText = result.vk+"€";
            $.get({
                url: "classes/descriptions/descriptions.json",
                success: function(data, status){
                    document.getElementById("productDescription").innerHTML = data[result.ID];
                }
            });
            document.getElementById("shop_button").setAttribute("value", value);
        }
    });
}

function shopping(id) {
    console.log(id);
    $.ajax({
        url : "api.php?action=shopping&productid="+id,
        success : function(result) {
            swal("Artikel erfolgreich hinzugefügt", "", "success");
        },
        statusCode: {
            403: function () {
                swal("Bitte melden Sie sich an oder registrieren Sie sich", "", "error")
            }
        }
    });
}
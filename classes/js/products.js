$(document).ready(function (){
    var div = document.getElementById("products");
    $.ajax({
        url : "api.php?action=products&category=sound",
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
        }
    });
}
$(document).ready(function (){
    var div = document.getElementById("products");
    $.ajax({
        url : "api.php?action=products&category=sound",
        dataType: 'json',
        success : function(result) {
            console.log(result[0]);
            for(var i = 0; i < result.length; i++){
                div.innerHTML +=
                    "<div onclick='loadProduct();' class='product'>" +
                        "<img src='img/products/"+result[i].ID+".png'>" +
                        "<p>"+result[i].name+"</p>" +
                    "</div>";
            }
        }
    });
});
function loadProduct() {
    console.log("Hello");
}
function shopping_delete(id) {
    $.ajax({
        url: "api.php?action=shopping_delete&productid="+id,
        success: function () {
            window.location.replace("index.php?request=shopping_cart");
        }
    })
}
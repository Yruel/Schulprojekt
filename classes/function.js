function ShowLogin() {
    $("#login-modal").modal("toggle");
}
function ShowRegister() {
    $("#register-modal").modal("toggle");
}
function getTest() {
    $.ajax({
		type : "GET",
		url : "api.php?action=products&category=sound",
		async : false,
		dataType : 'json',
		success : function(result) {
			if (result != null) {
                console.log(result);
            }
		}
	});
}
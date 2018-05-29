<?php
session_start();
include("config/config.php");

$tpl = new HTML_Template_PHPLIB('templates', 'keep');
$tpl->setFile(array(
		"main" => 'main.tpl.html',
		"nav" => 'nav.tpl.html',
		"products" => 'products.tpl.html'
));
$tpl->setVar("error", null);

if (!empty ($_POST["mail"]) || !empty ($_POST["password"])) {
	$get_user = $_POST["mail"];
	$get_pass = $_POST["password"];

	
	$log = checkLogin($get_user, $get_pass);

	if ($log == null) {
		$conn = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST.";charset=utf8", DBUSER, DBPASS);

		$query = "SELECT salutation, lastname from schulprojekt.user where mail = :mail";

		$stmt = $conn->prepare($query);
		$stmt->bindParam(":mail", $get_user);
		$stmt->execute();
		$result = $stmt->FetchAll(PDO::FETCH_ASSOC);

		$salutation = $result[0]['salutation'];
		$lastname = $result[0]['lastname'];

		$_SESSION['login'] = $lastname;
		
		print_r($salutation . $_SESSION["login"]);
	} else {
		$tpl->setVar("error", $log);
	}
}
if (! empty ( $_GET ["request"] )) {
	$action = $_GET ["request"];
} else {
	$action = "products";
}

switch($action) {
	case "home":
		$tpl->setBlock("home", "content");
		$tpl->setBlock("nav", "nav");
		$tpl->parse("nav", "nav");
		$tpl->parse("content", "home");
		break;
		
	case "products":
		$tpl->setBlock("products", "content");
		$tpl->setBlock("nav", "nav");
		$tpl->parse("nav", "nav");
		$tpl->parse("content", "products");

		if (!empty ($_GET["category"])) {
			$category = $_GET["category"];
		} else {
			$category = "sound";
		}
		$tpl->setVar("category", $category);
		break;
}

// }
// else if (!empty($_POST['username']) && !empty($_POST['password'])) {
//     $get_user = strtolower($_POST['username']);
//     $get_pass = $_POST['password'];

//     $res = getNdsEntries( "cn", $get_user );
//     $log = checkADSUser( $get_user, $get_pass );

//     if ($log == "ok") {
//         $_SESSION ["login"] = $get_user;
//         header ( "location: index.php" );
//     } else {
//         $tpl->setVar("errorLogin", $log);
//         $tpl->setVar("button","");
//         $tpl->setVar("nav","");
//         $tpl->setBlock("login", "content");
//         $tpl->parse("content", "login");
//     }
// }

$tpl->parse('out','main');
$tpl->p('out');
?>

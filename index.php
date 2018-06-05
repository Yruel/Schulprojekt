<?php
session_start();
include("config/config.php");

$tpl = new HTML_Template_PHPLIB('templates', 'keep');
$tpl->setFile(array(
		"main" => 'main.tpl.html',
		"nav" => 'nav.tpl.html',
		"products" => 'products.tpl.html',
		"shoppingCart" => 'shoppingCart.tpl.html',
		"buy" => 'buy.tpl.html'
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

		$_SESSION['login']['lastname'] = $lastname;
		$_SESSION['login']['salutation'] = $salutation;

	} else {
		$tpl->setVar("error", $log);
	}
}
if (! empty ( $_GET ["request"] )) {
	$action = $_GET ["request"];
} else {
	$action = "products";
}

if (isset($_SESSION['login'])){
	$user = $_SESSION['login']['lastname'];
	$salutation = $_SESSION['login']['salutation'];
}
else {
	$user = null;
	$salutation = null;
}
if(!isset($_SESSION["shopping_cart"])){
	$_SESSION["shopping_cart"] = [];
}

$tpl->setVar("user", $user);
$tpl->setVar("salutation", $salutation);

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

	case "shopping_cart":
        $tpl->setBlock("shoppingCart", "content");
        $tpl->setBlock("nav", "nav");
        $tpl->parse("nav", "nav");
        $tpl->parse("content", "shoppingCart");

        $shopping_cart = $_SESSION['shopping_cart'];

        $tpl->setVar("shoppingcart", json_encode($shopping_cart, JSON_FORCE_OBJECT));
        break;

	case "buy":
        $tpl->setBlock("buy", "content");
        $tpl->setBlock("nav", "nav");
        $tpl->parse("nav", "nav");
        $tpl->parse("content", "buy");
        break;

	case "logout":
		session_destroy();
		echo "<script>window.location.replace('index.php')</script>";
		break;
}

// }
// else if (!empty($_POST['username']) && !empty($_POST['password'])) {
//     $get_user = strtolower($_POST['username']);
//     $get_pass = $_POST['password'];

	case "impressum":
		$tpl->setBlock("nav", "nav");
		$tpl->parse("nav", "nav");
		break;
}

$tpl->parse('out','main');
$tpl->p('out');
?>

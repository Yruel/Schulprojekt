<?php
include("config/config.php");

$tpl = new HTML_Template_PHPLIB('templates', 'keep');
$tpl->setFile(array(
		"main" => 'main.tpl.html',
		"home" => 'home.tpl.html',
		"scheisse" => 'bla.tpl.html',
		"products" => 'products.tpl.html'
));

if (! empty ( $_GET ["request"] )) {
	$action = $_GET ["request"];
} else {
	$action = "home";
}

switch($action) {
	case "home":
		$tpl->setBlock("home", "content");
		$tpl->parse("content", "home");
		break;
		
	case "products":
		$tpl->setBlock("products", "content");
		$tpl->parse("content", "products");

		$category = $_GET["category"];

		//$conn = new PDO("mysql:dbname=schulprojekt; host=127.0.0.1", "root", "");
		//$query = "SELECT * FROM schulprojekt.products WHERE category = :category";
		//$stmt = $conn->prepare($query);
		//$stmt->bindParam(":category", $category);
		//$stmt->execute();
		//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		//$resultjson = json_encode($result);

		//$tpl->setVar("test", $resultjson);
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

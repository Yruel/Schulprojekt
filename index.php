<?php
include("config/config.php");

$tpl = new HTML_Template_PHPLIB('templates', 'keep');
$tpl->setFile(array(
		"main" => 'main.tpl.html',
		"home" => 'home.tpl.html',
		"scheisse" => 'bla.tpl.html'
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
		
	case "arsch":
		$tpl->setBlock("scheisse", "content");
		$tpl->setVar("variable", "Hurensohn!");
		
		
		$tpl->parse("content", "scheisse");
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

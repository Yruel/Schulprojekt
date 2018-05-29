<?php
function checkLogin($login, $password) {
    $conn = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST.";charset=utf8", DBUSER, DBPASS);

    if (empty ($login)) {
        return "Keine Email angegeben";
    }

    if (empty ($password)) {
        return "Kein Kennwort angegeben";
    }

    if (countUser($login) == 0) {
        return "User mit der mail: $login nicht gefunden.";
    } else {
        $query = "SELECT `password` from schulprojekt.user where mail = :mail";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":mail", $login);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = $result[0]['password'];

        if ($result === $password) {
            return null;
        } else {
            return "Kennwort falsch.";
        }
    }
}

function countUser($login)  {
    $conn = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST.";charset=utf8", DBUSER, DBPASS);

    $query = "SELECT count(*) as count from schulprojekt.user where mail = :mail";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":mail", $login);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $result = $result[0]['count'];
    return $result;
}
?>
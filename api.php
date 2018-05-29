<?php
session_start();
include_once("config/config.php");
$conn = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST.";charset=utf8", DBUSER, DBPASS);

    switch ($_GET["action"]) {
        case "products":
            $sql = "select * from schulprojekt";
            $category = $_GET["category"];

            $query = "SELECT ID, name, brand FROM schulprojekt.products WHERE category = :category";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":category", $category);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($result);
            break;
        case "product":
            $id = $_GET["id"];
            $query = "SELECT * FROM schulprojekt.products WHERE ID = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($result[0]);
            break;

        case "register":
            $salutation = $_GET["salutation"];
            $lastname = $_GET["lastname"];
            $name = $_GET["name"];
            $street = $_GET["street"];
            $house = $_GET["house"];
            $place = $_GET["place"];
            $postcode = $_GET["postcode"];
            $mail = $_GET["mail"];
            $password = $_GET["password"];

            $query = "insert into user (salutation, lastname, name, street, housenumber, place, postcode, mail, password) values (:salutation, :lastname, :name, :street, :house, :place, :postcode, :mail, :password)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":salutation", $salutation);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":street", $street);
            $stmt->bindParam(":house", $house);
            $stmt->bindParam(":place", $place);
            $stmt->bindParam(":postcode", $postcode);
            $stmt->bindParam(":mail", $mail);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            break;
    }
?>
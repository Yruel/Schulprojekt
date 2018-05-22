<?php
session_start();
include_once("config/config.php");
$conn = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST, DBUSER, DBPASS);

    switch ($_GET["action"]) {
        case "products":
            $sql = "select * from schulprojekt";
            $category = $_GET["category"];

            $query = "SELECT * FROM schulprojekt.products WHERE category = :category";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":category", $category);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($result);
        break;
    }
?>
<?php

function connectDB() {

    /* Connection Configs */
    $user = "root";
    $pass = "10068366";
    $dbname = "employees";
    $host = "localhost";

    try {
        $source = "mysql:host=$host;dbname=$dbname";
        $db = new PDO($source, $user, $pass, array("charset" => "utf8"));
        $db->query("SET CHARACTER SET utf8");
        return $db;
    } catch (PDOException $e) {
        echo "Connection Error Message: " . $e->getMessage() . "<br/>";
        die();
    }
}

function closeDB($db) {
    $db = null;
}

?>

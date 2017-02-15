<?php

include "dbconfig.php";

naturaljoin();

/**
 * Custom Query
 *
 * Returns an array of the custom join
 * 
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * joins user-specified tables
 */
function naturaljoin() {
  $obj = $_POST['myData'];
  $json = json_decode($obj, true);
  $db = connectDB();
    $query = "DROP TABLE IF EXISTS jointable CREATE TABLE jointable"; 

    $prep = $db->prepare("$query");
    $prep->execute();

    foreach($json as $name){
      $query = "SELECT * FROM jointable NATURAL JOIN" + $name; 

      $prep = $db->prepare("$query");
      $prep->execute();


    $join_result = array();

    foreach($prep as $row) {
      array_push($join_result, $row);
    }

    header("Content-Type: application/json");
    echo json_encode($join_result);

    closeDB($db);

}

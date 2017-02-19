<?php

include "dbconfig.php";

$db = connectDB();
$query = "SELECT dept_name FROM departments";

$prep = $db->prepare("$query");
$prep->execute();

$result = array();

foreach($prep as $row) {
    array_push($result, $row["dept_name"]);
}

header("Content-Type: application/json");
echo json_encode($result);

closeDB($db);

?>

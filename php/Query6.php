<?php

include "dbconfig.php";

Query6();

/**
 * Query6
 *
 * Please give me 10 random employees that work in a given department.
 */
function Query6() {

    $db = connectDB();
    $departs = $_POST["departs"];

    // selects 10 random employees from employees table
    $query = ("
        SELECT e.first_name, e.last_name
        FROM employees e
		ORDER BY RAND()
		LIMIT 10;
    );

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array();

    /** All I need is the first and last names of 10 people */
    foreach($prep as $row) {
        array_push($result, array(
            "firstName" => $row["first_name"],
            "lastName" => $row["last_name"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?>

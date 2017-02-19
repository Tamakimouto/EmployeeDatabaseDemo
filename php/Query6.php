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

    // Please correct this SQL Statement
    $query = ("
        SELECT 10_people FROM employees
        WHERE persons_department IN (" . implode(",", $departs). ")"
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

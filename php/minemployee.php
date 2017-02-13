<?php

include "dbconfig.php";

departmentFewestEmployees();

/**
 * departmentFewestEmployees
 *
 * Returns an array of the departments with the fewest
 * employees as JSON.
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches all 1 or more departments with the lowest number of employees.
 */
function departmentFewestEmployees() {
    $db = connectDB();
    $query = ""; /* <--- TO DO -------- */

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array();

    foreach($prep as $row) {
        array_push($result, $row["DepartmentName"]); /* <----- TO DO (?) ---- */
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?>

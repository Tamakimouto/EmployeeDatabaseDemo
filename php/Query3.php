<?php

include "dbconfig.php";

Query3();

/**
 * Query3
 *
 * Returns an array of the managers who hold office with the longest
 * duration as JSON.
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches managers who have held office for the longest duration.
 */
function Query3() {
    $db = connectDB();
    $query = "SELECT MIN(empCount) FROM (SELECT dept_name, COUNT(dept_no) AS empCount FROM departments, employees, dept_emp WHERE employees.emp_no = dept_emp.emp_no AND dept_emp.dept_no = departments.dept_no)"; /* <--- TO DO -------- */

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


<?php

include "dbconfig.php";

Query1();

/**
 * Query1
 *
 * Returns an array of the departments with the fewest
 * employees as JSON.
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches all 1 or more departments with the lowest number of employees.
 */
function Query1() {
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

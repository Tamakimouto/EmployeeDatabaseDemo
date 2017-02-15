<?php

include "dbconfig.php";

Query1();

/**
 * Query1
 *
 * Returns an array of the department with the fewest
 * employees as JSON.
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches the department with the lowest number of employees.
 */
function Query1() {
    $db = connectDB();
    $query = "SELECT dept_name, COUNT(departments.dept_no) AS empCount FROM departments, employees, dept_emp WHERE employees.emp_no = dept_emp.emp_no AND dept_emp.dept_no = departments.dept_no GROUP BY dept_name HAVING empCount < 17500;"; /* <--- TO DO -------- */

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array();

    foreach($prep as $row) {
        array_push($result, $row["dept_name"]); /* <----- TO DO (?) ---- */
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?


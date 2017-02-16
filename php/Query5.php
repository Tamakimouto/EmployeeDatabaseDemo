<?php

include "dbconfig.php";

Query5();

/**
 * Query5
 *
 * Returns an array of employees who are female, born before Jan 1, 1990, 
 * make more than 80K annually and currently hold a manager position
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches all empolyees who are female, born before Jan 1, 1990, 
 * make more than 80K annually and currently hold a manager position
 */
function Query5() {
    $db = connectDB();
    $query = "SELECT DISTINCT e.first_name, e.last_name, e.gender, s.salary, e.birth_date
	FROM employees e, salaries s, dept_manager dm
	WHERE e.gender = 'F' AND e.birth_date < '1990-01-01' AND s.salary > '80000' AND e.emp_no = s.emp_no
	AND dm.emp_no = e.emp_no AND dm.to_date > CURDATE()";

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array();

    foreach($prep as $row) {
        array_push($result, $row["first_name"]);
		array_push($result, $row["last_name"]);
		array_push($result, $row["gender"]);
		array_push($result, $row["salary"]);
		array_push($result, $row["birth_date"]);
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?>
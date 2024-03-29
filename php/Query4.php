<?php

include "dbconfig.php";

Query4();

/**
 * Query4
 *
 * Returns an array of each department with the number of employees
 * born in each decade and their average salaries
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches for each department: the number of employees born in each 
 * decade and their average salaries
 */
function Query4() {

    $db = connectDB();

    $query = ("
        SELECT d.dept_name, ROUND(YEAR(e.birth_date), -1) AS birth_date, count(e.emp_no) as count, AVG(s.salary) as avg_salary
        FROM employees e, salaries s, dept_emp de, departments d
        WHERE e.emp_no = s.emp_no AND e.emp_no = de.emp_no AND d.dept_no = de.dept_no
        GROUP BY d.dept_name, ROUND(YEAR(e.birth_date), -1)
    ");

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array("query" => 4, "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "department" => $row["dept_name"],
            "decade" => $row["birth_date"],
            "count" => $row["count"],
            "avgSalary" => $row["avg_salary"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?>

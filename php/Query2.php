<?php

include "dbconfig.php";

Query2();

/**
 * Query2
 *
 * Returns an array of salaries with the maximum ratio of
 * average female salaries to average men salaries.
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches all salaries with the maximum ratio of avg female salaries
 * avg male salaries.
 */
function Query2() {
    $db = connectDB();
    $query = ("SELECT DISTINCT MAX(y.avgFemale/x.avgMale) AS 'female:male salary', y.dept_name 
        FROM (
                SELECT departments.dept_name, AVG(salary) AS avgMale 
                FROM salaries, employees, dept_emp, departments 
                WHERE employees.emp_no = salaries.emp_no 
                AND employees.emp_no = dept_emp.emp_no
                AND departments.dept_no = dept_emp.dept_no 
                AND gender = 'M'
                GROUP BY dept_emp.dept_no) x 
        JOIN (SELECT departments.dept_name, AVG (salary) AS avgFemale
                FROM salaries, employees, dept_emp, departments 
                WHERE employees.emp_no = salaries.emp_no 
                AND employees.emp_no = dept_emp.emp_no
                AND departments.dept_no = dept_emp.dept_no 
                AND gender = 'F'
                GROUP BY dept_emp.dept_no) y
	ON 1=1
	GROUP BY y.dept_name
	HAVING MAX(y.avgFemale/x.avgMale) > 1.4;");

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array("query" => 2, "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "department" => $row["dept_name"],
            "ratio" => $row["female:male_avg_salary"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?>


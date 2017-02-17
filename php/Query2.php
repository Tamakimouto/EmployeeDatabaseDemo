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
    $query = (
        "SELECT y.avgFemale/x.avgMale AS 'female:male_avg_salary'
        FROM (SELECT AVG(salary) AS avgMale
        FROM salaries, employees
        WHERE employees.emp_no = salaries.emp_no
        AND gender = 'M') x
        JOIN (SELECT AVG(salary) AS avgFemale
        FROM salaries, employees
        WHERE employees.emp_no = salaries.emp_no
        AND gender = 'F')y ON 1=1");

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array("query" => 2, "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "ratio" => $row["female:male_avg_salary"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

}

?>


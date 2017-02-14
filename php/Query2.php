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
	$queryMale = "SELECT AVG(salary) AS avgMale FROM salaries, employees WHERE employees.emp_no = salaries.emp_no AND gender = 'M'";
	$queryFemale = "SELECT AVG(salary) AS avgFemale FROM salaries, employees WHERE employees.emp_no = salaries.emp_no AND gender = 'F'";
	$query = "SELECT MAX(avgMale/avgFemale)"; /* <--- TO DO -------- */

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


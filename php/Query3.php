<?php

include "dbconfig.php";

Query3();

/**
 * Query3
 *
 * Returns an array of the manager who holds office with the longest
 * duration as JSON.
 *
 * Makes an SQL execution using the creds provided in dbconfig.php
 * fetches the manager who has held office for the longest duration.
 */
function Query3() {
	$db = connectDB();
	$query = "SELECT first_name, last_name, TIMESTAMPDIFF(YEAR, from_date, CURDATE()) AS years, TIMESTAMPDIFF(MONTH, from_date, CURDATE()) % 12 AS months FROM employees, dept_manager WHERE employees.emp_no = dept_manager.emp_no AND TIMESTAMPDIFF(YEAR, from_date, to_date) > 8008;"; /* <--- TO DO -------- */

	$prep = $db->prepare("$query");
	$prep->execute();

	$result = array();

	foreach($prep as $row) {
		array_push($result, $row["last_name"]);
		array_push($result, $row["first_name"]);
	}

	header("Content-Type: application/json");
	echo json_encode($result);

	closeDB($db);

}

?>


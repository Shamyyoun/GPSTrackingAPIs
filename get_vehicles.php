<?php

require_once 'connection.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['username'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);

    // validate required inputs
    if (empty($username)) {
        echo "error";
        return;
    }

    // inputs in final form
    $username = strip_tags($username);

    // prepare sql statement
    $sql = "SELECT * FROM vehicles WHERE user_id = '$username'";

    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // get vehicles
	$vehicles = array();
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
			$vehicle = array(
				'id' => $row['id'],
				'password' => $row['password'],
				'name' => $row['name'],
				'purpose' => $row['purpose'],
				'licence_number' => intval($row['licence_number']),
				'number' => intval($row['number']),
				'color' => $row['color'],
				'year' => intval($row['year']),
				'model' => $row['model'],
				'brand' => $row['brand'],
				'lat' => doubleval($row['lat']),
				'lng' => doubleval($row['lng']),
				'trip_status' => intval($row['trip_status'])
			);

			$vehicles[] = $vehicle;
        }
    }
	
	echo json_encode($vehicles);
} else {
    echo "error";
}
?>
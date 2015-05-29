<?php

require_once 'connection.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['vehicle_id'])) {

    // escape sql statements from parameters
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);

    // validate required inputs
    if (empty($vehicle_id)) {
        echo "error";
        return;
    }

    // inputs in final form
	$vehicle_id = strip_tags($vehicle_id);

    // prepare sql statement
    $sql = "SELECT lat, lng FROM vehicles WHERE id = '$vehicle_id'";
	
    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // get location
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
			$location = array(
				'lat' => doubleval($row['lat']),
				'lng' => doubleval($row['lng'])
			);

			echo json_encode($location);			
        }
    } else {
		echo "error";
	}
} else {
    echo "error";
}
?>
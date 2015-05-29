<?php

require_once 'connection.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['vehicle_id'])) {

    // escape sql statements from parameters
    $trip_id = mysql_real_escape_string($_GET['vehicle_id']);

    // validate required inputs
    if (empty($trip_id)) {
        echo "error";
        return;
    }

    // inputs in final form
    $trip_id = strip_tags($trip_id);

    // prepare sql statement
    $sql = "SELECT * FROM trips WHERE vehicle_id = '$trip_id'";

    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // get trips
	$trips = array();
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
			$trip = array(
				'id' => $row['id'],
				'start_lat' => doubleval($row['start_lat']),
				'start_lng' => doubleval($row['start_lng']),
				'start_location_title' => $row['start_location_title'],
				'start_time' => $row['start_time'],
				'end_lat' => doubleval($row['end_lat']),
				'end_lng' => doubleval($row['end_lng']),
				'end_location_title' => $row['end_location_title'],
				'end_time' => $row['end_time']
			);

			$trips[] = $trip;
        }
    }
	
	echo json_encode($trips);
} else {
    echo "error";
}
?>
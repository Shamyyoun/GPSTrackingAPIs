<?php

require_once 'connection.php';
require_once 'functions.php';

if (isset($_GET['vehicle_id']) || isset($_GET['time']) || isset($_GET['lat']) || isset($_GET['lng']) || isset($_GET['mode'])) {

    // escape sql statements from parameters
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);
	$time = mysql_real_escape_string($_GET['time']);
	$lat = mysql_real_escape_string($_GET['lat']);
	$lng = mysql_real_escape_string($_GET['lng']);
	$mode = mysql_real_escape_string($_GET['mode']);
	
	// validate required inputs
    if (empty($vehicle_id) || empty($time) || empty($lat) || empty($lng) || empty($mode)) {
        echo "error";
        return;
    }
	
	// inputs in final form
	$vehicle_id = strip_tags($vehicle_id);
	$time = strip_tags($time);
	$lat = strip_tags($lat);
	$lng = strip_tags($lng);
	$mode = strip_tags($mode);
	
	// get location title
	$location_title = getPlaceName($lat, $lng);
	
	// check mode
	if ($mode === "start") {
		// delete non completed trips from DB
		$sql1 = "DELETE FROM trips WHERE end_time = '0000-00-00 00:00:00' AND vehicle_id = '$vehicle_id'";
		mysql_query($sql1);
		
		// insert new trip in DB
		$sql2 = "INSERT INTO trips (start_lat, start_lng, start_location_title, start_time, vehicle_id)"
					. " VALUES ($lat, $lng, '$location_title', '$time', '$vehicle_id')";
		
		$result2 = mysql_query($sql2);

		// check query result
		if ($result2) {
			// update vehicle's trip_status in DB
			$sql3 = "UPDATE vehicles SET trip_status = 1 WHERE id = '$vehicle_id'";
			$result3 = mysql_query($sql3);
			if($result3) {
				// output insert id
				echo "success";
			} else {
				echo "error";
			}
		} else {
			echo "error";
		}
		
		// close DB connection
		mysql_close($con);
		
	} else if ($mode === "end") {
		// get last trip id from DB
		$sql1 = "SELECT id from trips WHERE vehicle_id = '$vehicle_id' ORDER BY id DESC LIMIT 1";
		$result1 = mysql_query($sql1);
		if (mysql_num_rows($result1) > 0) {
			while ($row1 = mysql_fetch_array($result1)) {
				$trip_id = $row1['id'];
				
				// update trip in DB
				$sql2 = "UPDATE trips SET end_lat = $lat, end_lng = $lng, end_location_title = '$location_title',"
							. " end_time = '$time' WHERE id = $trip_id";
		
				$result2 = mysql_query($sql2);

				// check query result
				if ($result2) {
					// update vehicle's trip_status in DB
					$sql3 = "UPDATE vehicles SET trip_status = 2 WHERE id = '$vehicle_id'";
					$result3 = mysql_query($sql3);
					if($result3) {
						echo "success";
					} else {
						echo "error";
					}
				} else {
					echo "error";
				}
			}
		} else {
			echo "error";
		}
		
		// close DB connection
		mysql_close($con);
	} else {
		echo "error";
        return;
	}
	
} else {
    echo "error";
}
?>
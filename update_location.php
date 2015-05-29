<?php

require_once 'connection.php';

if (isset($_GET['username']) && isset($_GET['vehicle_id']) && isset($_GET['lat']) && isset($_GET['lng'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);
	$lat = doubleval(mysql_real_escape_string($_GET['lat']));
	$lng = doubleval(mysql_real_escape_string($_GET['lng']));

    // validate required inputs
    if (empty($username) || empty($vehicle_id) || $lat == 0 || $lng == 0) {
        echo "error";
        return;
    }

    // inputs in final form
    $username = strip_tags($username);
	$vehicle_id = strip_tags($vehicle_id);

    // prepare sql statement
    $sql = "UPDATE vehicles SET lat = $lat, lng = $lng, time_stamp = NOW() WHERE user_id = '$username' AND id = '$vehicle_id'";
	
    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query resuult
    if ($result) {
        echo "success";
    } else {
		echo "error";
	}
} else {
    echo "error";
}
?>
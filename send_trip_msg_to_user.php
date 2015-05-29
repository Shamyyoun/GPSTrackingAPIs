<?php

require_once 'connection.php';
require_once 'GCMPushMessage.php';
require_once 'constants.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['username']) && isset($_GET['vehicle_id']) && isset($_GET['mode']) && isset($_GET['trip_msg'])) {

    // escape sql statements from parameters
	$username = mysql_real_escape_string($_GET['username']);
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);
	$mode = mysql_real_escape_string($_GET['mode']);
	$trip_msg = mysql_real_escape_string($_GET['trip_msg']);

    // validate required inputs
    if (empty($username) || empty($vehicle_id) || empty($mode) || empty($trip_msg)) {
        echo "error";
        return;
    }

    // inputs in final form
	$username = strip_tags($username);
	$vehicle_id = strip_tags($vehicle_id);
	$mode = strip_tags($mode);
	$trip_msg = strip_tags($trip_msg);

	// --get reg_id from db--
	// prepare sql statement
	$sql = "SELECT reg_id FROM users WHERE username = '$username'";
		
    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check result
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
			// send push notification
			$reg_id = $row['reg_id'];
            $gcpm = new GCMPushMessage($api_key);
            $gcpm->setDevices($reg_id);
            $gcm_result = $gcpm->send($trip_msg, array(
                'key' => 'trip',
				'mode' => $mode,
				'vehicle_id' => $vehicle_id
				));
			
			echo $gcm_result;
        }
    } else {
		echo "error";
	}
} else {
    echo "error";
}
?>
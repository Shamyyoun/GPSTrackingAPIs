<?php

require_once 'connection.php';
require_once 'GCMPushMessage.php';
require_once 'constants.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['vehicle_id']) && isset($_GET['turn_msg'])) {

    // escape sql statements from parameters
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);
	$turn_msg = mysql_real_escape_string($_GET['turn_msg']);

    // validate required inputs
    if (empty($vehicle_id) || empty($turn_msg)) {
        echo "error";
        return;
    }

    // inputs in final form
	$vehicle_id = strip_tags($vehicle_id);
	$turn_msg = strip_tags($turn_msg);

	// --get vehicle reg_id from db--
    // prepare sql statement
    $sql = "SELECT reg_id FROM vehicles WHERE id = '$vehicle_id'";
	
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
            $gcm_result = $gcpm->send($turn_msg, array(
                'key' => 'turn'));
			
			echo $gcm_result;
        }
    } else {
		echo "error";
	}
} else {
    echo "error";
}
?>
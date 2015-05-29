<?php

require_once 'connection.php';
require_once 'GCMPushMessage.php';
require_once 'constants.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['username']) && isset($_GET['vehicle_name'])) {

    // escape sql statements from parameters
	$username = mysql_real_escape_string($_GET['username']);
	$vehicle_name = mysql_real_escape_string($_GET['vehicle_name']);

    // validate required inputs
    if (empty($username) || empty($vehicle_name)) {
        echo "error";
        return;
    }

    // inputs in final form
	$username = strip_tags($username);

	// --get user's reg_id from db--
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
            $gcm_result = $gcpm->send($vehicle_name, array(
                'key' => 'help'));
			
			echo $gcm_result;
        }
    } else {
		echo "error";
	}
} else {
    echo "error";
}
?>
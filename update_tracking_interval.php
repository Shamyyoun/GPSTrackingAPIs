<?php

require_once 'connection.php';
require_once 'GCMPushMessage.php';
require_once 'constants.php';

if (isset($_GET['username']) && isset($_GET['tracking_interval'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);
	$tracking_interval = mysql_real_escape_string($_GET['tracking_interval']);

    // validate required inputs
    if (empty($username) || empty($tracking_interval)) {
        echo "error";
        return;
    }
	if (intval($tracking_interval) == 0) {
		echo "error";
        return;
	}

    // inputs in final form
    $username = strip_tags($username);
	$tracking_interval = strip_tags($tracking_interval);
	
    // prepare sql statement
    $sql1 = "UPDATE users SET tracking_interval = '$tracking_interval' WHERE username = '$username'";
	
    // execute query
    $result1 = mysql_query($sql1);

    // check query resuult
    if ($result1) {
		// get reg_ids from database
		$sql2 = "SELECT reg_id from vehicles WHERE user_id = '$username'";
		$result2 = mysql_query($sql2);
	
		$reg_ids = array();
		while ($row2 = mysql_fetch_array($result2)) {
			$reg_ids[] = $row2['reg_id'];
		}
		
		// send push notification to user's vehicles
		$gcpm = new GCMPushMessage($api_key);
        $gcpm->setDevices($reg_ids);
        $gcpm->send($tracking_interval, array(
				'key' => 'tracking_interval_updated'));
		
        echo "success";
    } else {
		echo "error";
	}
	
	mysql_close($con);
} else {
    echo "error";
}
?>
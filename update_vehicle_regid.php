<?php

require_once 'connection.php';

if (isset($_POST['vehicle_id']) && isset($_POST['reg_id'])) {

    // escape sql statements from parameters
	$vehicle_id = mysql_real_escape_string($_POST['vehicle_id']);
	$reg_id = mysql_real_escape_string($_POST['reg_id']);

    // validate required inputs
    if (empty($vehicle_id) || empty($reg_id)) {
        echo "error";
        return;
    }

    // inputs in final form
	$vehicle_id = strip_tags($vehicle_id);
	$reg_id = strip_tags($reg_id);

    // prepare sql statement
    $sql = "UPDATE vehicles SET reg_id = '$reg_id', time_stamp = NOW() WHERE id = '$vehicle_id'";
	
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
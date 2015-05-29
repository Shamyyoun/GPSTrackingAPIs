<?php

require_once 'connection.php';

if (isset($_GET['vehicle_id'])) {

    // escape sql statements from parameters
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);

    // validate required inputs
    if (empty($vehicle_id)) {
        echo "error";
        return;
    }
	
	// strip tags
	$vehicle_id = strip_tags($vehicle_id);

    // prepare sql statement
    $sql = "DELETE FROM vehicles WHERE id = '$vehicle_id'";

    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query result
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
	
} else {
    echo "error";
}
?>
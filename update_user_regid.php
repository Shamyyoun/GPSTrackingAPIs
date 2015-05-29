<?php

require_once 'connection.php';

if (isset($_POST['username']) && isset($_POST['reg_id'])) {

    // escape sql statements from parameters
	$username = mysql_real_escape_string($_POST['username']);
	$reg_id = mysql_real_escape_string($_POST['reg_id']);

    // validate required inputs
    if (empty($username) || empty($reg_id)) {
        echo "error";
        return;
    }

    // inputs in final form
	$username = strip_tags($username);
	$reg_id = strip_tags($reg_id);

    // prepare sql statement
    $sql = "UPDATE users SET reg_id = '$reg_id' WHERE username = '$username'";
	
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
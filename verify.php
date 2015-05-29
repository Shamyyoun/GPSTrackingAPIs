<?php

require_once 'connection.php';

if (isset($_GET['username']) && isset($_GET['ver_number'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);
    $ver_number = mysql_real_escape_string($_GET['ver_number']);

    // validate required inputs
    if (empty($username) || empty($ver_number)) {
        echo "error";
        return;
    }

    // inputs in final form
    $username = strip_tags($username);
    $ver_number = strip_tags($ver_number);

    // get stored verification number from db
    $sql1 = "SELECT ver_number FROM users WHERE username = '$username'";
    $result1 = mysql_query($sql1);
    
    if (mysql_num_rows($result1) > 0) {
        while ($row = mysql_fetch_array($result1)) {
            // check if equal stored number
			if($ver_number === $row['ver_number']) {
				// update verified flag in DB
				$sql2 = "UPDATE users SET verified = TRUE";
				$result2 = mysql_query($sql2);
				
				if($result2) {
					// output success msg
					echo 'Account verified successfully.<br />Thank you for using GPS Tracking app.';
				} else {
					echo 'error';
				}
			} else {
				echo 'error';
			}
        }
    } else {
        echo "error";
    }
	
	mysql_close($con);
} else {
    echo "error";
}
?>
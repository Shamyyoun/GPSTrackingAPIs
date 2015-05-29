<?php

require_once 'connection.php';

if (isset($_GET['username'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);

    // validate required inputs
    if (empty($username)) {
        echo "error";
        return;
    }

    // inputs in final form
    $username = strip_tags($username);

    // prepare sql statement
    $sql = "SELECT name, password, email FROM users WHERE username = '$username'";

    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query result
    if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_array($result)) {
			// send email
			$name = $row['name'];
			$password = $row['password'];
			$email = $row['email'];
			$msg = "Dear $name,\n"
					. "Your account password is: $password";
			$msg = wordwrap($msg, 70);
			$headers = "From: gpstracking@mahmoudelshamy.com";
			mail($email, "GPS Tracking - Account Password", $msg, $headers);
			
			echo "success";
		}
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
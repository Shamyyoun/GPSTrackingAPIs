<?php

require_once 'connection.php';

if (isset($_GET['username']) && isset($_GET['password']) && isset($_GET['email']) && isset($_GET['name']) && isset($_GET['type'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);
    $password = mysql_real_escape_string($_GET['password']);
	$email = mysql_real_escape_string($_GET['email']);
    $name = mysql_real_escape_string($_GET['name']);
    $type = mysql_real_escape_string($_GET['type']);
    $address = mysql_real_escape_string($_GET['address']);
    $org_type = mysql_real_escape_string($_GET['org_type']);

    // validate required inputs
    if (empty($username) || empty($password) || empty($email) || empty($name) || empty($type)) {
        echo "error";
        return;
    }

    // inputs in final form
    $username = strip_tags($username);
    $password = strip_tags($password);
	$email = strip_tags($email);
    $name = strip_tags($name);
    $type = strip_tags($type);
    $address = strip_tags($address);
    $org_type = strip_tags($org_type);
    $ver_number = rand();
	
	// check account type
	if ($type == 1) {
		// personal account >> make address and org_type empty
		$address = "";
		$org_type = "";
	}

    // prepare sql statement
    $sql = "INSERT INTO users (username, password, email, name, type, address, org_type, ver_number)"
            . " VALUES ('$username', '$password', '$email', '$name', '$type', '$address', '$org_type', $ver_number)";

    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query result
    if ($result) {
        // send verification email
        $verification_link = $_SERVER['HTTP_HOST'] . "/verify.php?username=$username&ver_number=$ver_number";
        $msg = "Welcome $name to GPS Tracking app.\n"
                . "One more step to activate your account, please folow link below:\n"
                . $verification_link;
        $msg = wordwrap($msg, 70);
		$headers = "From: gpstracking@mahmoudelshamy.com";
        mail($email, "GPS Tracking", $msg, $headers);

        echo "success";
    } else {
        // username exists
        echo "exists";
    }
} else {
    echo "error";
}
?>
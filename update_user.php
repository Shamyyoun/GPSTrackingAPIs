<?php

require_once 'connection.php';

if (isset($_GET['username'])) {

    // prepare parameters
	$username = mysql_real_escape_string($_GET['username']);
	$username = strip_tags($username);
	if(isset($_GET['password'])) {
		$password = mysql_real_escape_string($_GET['password']);
		$password = strip_tags($password);
	}
	if(isset($_GET['email'])) {
		$email = mysql_real_escape_string($_GET['email']);
		$email = strip_tags($email);
	}
	if(isset($_GET['name'])) {
		$name = mysql_real_escape_string($_GET['name']);
		$name = strip_tags($name);
	}
	if(isset($_GET['address'])) {
		$address = mysql_real_escape_string($_GET['address']);
		$address = strip_tags($address);
	}
	if(isset($_GET['org_type'])) {
		$org_type = mysql_real_escape_string($_GET['org_type']);
		$org_type = strip_tags($org_type);
	}

    // validate required inputs
    if (empty($username)) {
        echo "error";
        return;
    }

    // prepare sql statement
    $sql = "UPDATE users SET username = '$username'";
	if(isset($password)) {
		$sql .= ", password = '$password'";
	}
	if(isset($email)) {
		$sql .= ", email = '$email'";
	}
	if(isset($name)) {
		$sql .= ", name = '$name'";
	}
	if(isset($address)) {
		$sql .= ", address = '$address'";
	}
	if(isset($org_type)) {
		$sql .= ", org_type = '$org_type'";
	}
	$sql .= " WHERE username = '$username'";

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
<?php

require_once 'connection.php';

if (isset($_GET['vehicle_id'])) {

    // prepare parameters
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);
	$vehicle_id = strip_tags($vehicle_id);
	if(isset($_GET['password'])) {
		$password = mysql_real_escape_string($_GET['password']);
		$password = strip_tags($password);
	}
	if(isset($_GET['name'])) {
		$name = mysql_real_escape_string($_GET['name']);
		$name = strip_tags($name);
	}
	if(isset($_GET['purpose'])) {
		$purpose = mysql_real_escape_string($_GET['purpose']);
		$purpose = strip_tags($purpose);
	}
	if(isset($_GET['licence_number'])) {
		$licence_number = mysql_real_escape_string($_GET['licence_number']);
		$licence_number = strip_tags($licence_number);
		$licence_number = intval($licence_number);
	}
	if(isset($_GET['number'])) {
		$number = mysql_real_escape_string($_GET['number']);
		$number = strip_tags($number);
		$number = intval($number);
	}
	if(isset($_GET['color'])) {
		$color = mysql_real_escape_string($_GET['color']);
		$color = strip_tags($color);
	}
	if(isset($_GET['model'])) {
		$model = mysql_real_escape_string($_GET['model']);
		$model = strip_tags($model);
	}
	if(isset($_GET['year'])) {
		$year = mysql_real_escape_string($_GET['year']);
		$year = strip_tags($year);
		$year = intval($year);
	}
	if(isset($_GET['brand'])) {
		$brand = mysql_real_escape_string($_GET['brand']);
		$brand = strip_tags($brand);
	}

    // validate required inputs
    if (empty($vehicle_id)) {
        echo "error";
        return;
    }

    // prepare sql statement
    $sql = "UPDATE vehicles SET id = '$vehicle_id'";
	if(isset($password)) {
		$sql .= ", password = '$password'";
	}
	if(isset($name)) {
		$sql .= ", name = '$name'";
	}
	if(isset($purpose)) {
		$sql .= ", purpose = '$purpose'";
	}
	if(isset($licence_number)) {
		$sql .= ", licence_number = $licence_number";
	}
	if(isset($number)) {
		$sql .= ", number = $number";
	}
	if(isset($color)) {
		$sql .= ", color = '$color'";
	}
	if(isset($year)) {
		$sql .= ", year = $year";
	}
	if(isset($model)) {
		$sql .= ", model = '$model'";
	}
	if(isset($brand)) {
		$sql .= ", brand = '$brand'";
	}
	$sql .= ", time_stamp = NOW() WHERE id = '$vehicle_id'";

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
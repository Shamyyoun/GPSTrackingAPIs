<?php

require_once 'connection.php';

if (isset($_GET['username']) && isset($_GET['vehicle_id']) && isset($_GET['password']) && isset($_GET['name'])) {

    // escape sql statements from parameters
	$username = mysql_real_escape_string($_GET['username']);
	$vehicle_id = mysql_real_escape_string($_GET['vehicle_id']);
    $password = mysql_real_escape_string($_GET['password']);
    $name = mysql_real_escape_string($_GET['name']);
    $purpose = mysql_real_escape_string($_GET['purpose']);
    $licence_number = intval(mysql_real_escape_string($_GET['licence_number']));
	$number = intval(mysql_real_escape_string($_GET['number']));
    $color = mysql_real_escape_string($_GET['color']);
	$model = mysql_real_escape_string($_GET['model']);
	$year = intval(mysql_real_escape_string($_GET['year']));
	$brand = mysql_real_escape_string($_GET['brand']);

    // validate required inputs
    if (empty($username) || empty($vehicle_id) || empty($password) || empty($name)) {
        echo "error";
        return;
    }

    // inputs in final form
	$username = strip_tags($username);
	$vehicle_id = strip_tags($vehicle_id);
    $password = strip_tags($password);
    $name = strip_tags($name);
    $purpose = strip_tags($purpose);
    $licence_number = strip_tags($licence_number);
	$number = strip_tags($number);
	$color = strip_tags($color);
	$model = strip_tags($model);
	$year = strip_tags($year);
	$brand = strip_tags($brand);

    // prepare sql statement
    $sql = "INSERT INTO vehicles (id, password, name, purpose, licence_number, number, color, model, year, brand, user_id)"
			. " VALUES ('$vehicle_id', '$password', '$name', '$purpose', $licence_number, $number, '$color', '$model', $year, '$brand', '$username')";
			
    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query result
    if ($result) {
        echo "success";
    } else {
        // vehicle id exists
        echo "exists";
    }
} else {
    echo "error";
}
?>
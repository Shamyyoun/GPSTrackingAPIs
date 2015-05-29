<?php

require_once 'connection.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['id']) && isset($_GET['password'])) {

    // escape sql statements from parameters
    $id = mysql_real_escape_string($_GET['id']);
    $password = mysql_real_escape_string($_GET['password']);

    // validate required inputs
    if (empty($id) || empty($password)) {
        echo "error";
        return;
    }

    // inputs in final form
    $id = strip_tags($id);
    $password = strip_tags($password);

    // prepare sql statement
    $sql = "SELECT vehicles.*, users.tracking_interval FROM vehicles INNER JOIN users"
				. " ON vehicles.user_id = users.username"
				. " WHERE vehicles.id = '$id' AND vehicles.password = '$password'";
				
    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query result
    if (mysql_num_rows($result) > 0) {
        // exists
        while ($row = mysql_fetch_array($result)) {
			$vehicle = array(
                'id' => $row['id'],
                'password' => $row['password'],
				'name' => $row['name'],
				'purpose' => $row['purpose'],
                'licence_number' =>  intval($row['licence_number']),
                'number' =>  intval($row['number']),
                'color' => $row['color'],
				'model' => $row['model'],
				'year' => intval($row['year']),
				'brand' => $row['brand'],
				'tracking_interval' => intval($row['tracking_interval']),
				'username' => $row['user_id']
            );
                
            echo json_encode($vehicle);
        }
    } else {
        // not exists 
        echo "error";
    }
} else {
    echo "error";
}
?>
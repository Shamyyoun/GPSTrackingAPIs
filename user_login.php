<?php

require_once 'connection.php';

// change content type to json
header('Content-type: application/json');

if (isset($_GET['username']) && isset($_GET['password'])) {

    // escape sql statements from parameters
    $username = mysql_real_escape_string($_GET['username']);
    $password = mysql_real_escape_string($_GET['password']);

    // validate required inputs
    if (empty($username) || empty($password)) {
        echo "error";
        return;
    }

    // inputs in final form
    $username = strip_tags($username);
    $password = strip_tags($password);

    // prepare sql statement
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // execute query
    $result = mysql_query($sql);
    mysql_close($con);

    // check query result
    if (mysql_num_rows($result) > 0) {
        // exists
        while ($row = mysql_fetch_array($result)) {
            // check verified
            $verified = $row['verified'];
            if ($verified) {
                // output user's info in json
                $user = array(
                    'username' => $row['username'],
                    'password' => $row['password'],
					'email' => $row['email'],
                    'name' => $row['name'],
                    'type' => intval($row['type']),
                    'address' => $row['address'],
                    'org_type' => $row['org_type'],
					'tracking_interval' => intval($row['tracking_interval'])
                );
                
                echo json_encode($user);
            } else {
                echo 'not_verified';
            }
        }
    } else {
        // not exists 
        echo "error";
    }
} else {
    echo "error";
}
?>
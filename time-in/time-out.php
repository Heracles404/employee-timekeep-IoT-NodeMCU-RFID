<?php
include_once('connects.php');

$uid = $firstname = $lastname = $picture = "";

if(isset($_GET['UID'])) {
    // Get UID from the request
    $uid = $_GET['UID'];

    // Query database for UID, first name, last name, and picture associated with the UID
    $query = "SELECT UID, f_name, l_name, picture FROM accounts WHERE UID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    $stmt->bind_result($fetched_uid, $f_name, $l_name, $fetched_picture);

    // Fetch the result
    if($stmt->fetch()) {
    // Assign fetched values to variables
    $uid = $fetched_uid;
    $firstname = $f_name;
    $lastname = $l_name;
    $picture = $fetched_picture;

    // Display first name and last name
    echo "First Name: $firstname, Last Name: $lastname, UID: $uid";

    // Record time-in of employee in the "time_records" table
    $current_time = date('Y-m-d H:i:s');
    $insert_query = "INSERT INTO time_records (UID, time_in) VALUES (?, ?)";
    $stmt_insert = $con->prepare($insert_query);
    $stmt_insert->bind_param('ss', $uid, $current_time);
    $stmt_insert->execute();
    $stmt_insert->close();
    } else {
    echo "No information found for UID: $uid";
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
} else {
echo "";

}
?>
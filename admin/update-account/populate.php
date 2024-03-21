<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nodemcu_rfid_iot";

// Connection
$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection Failed: ". $con->connect_error);
}

$UID = $_POST["UID"];
$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
$email = $_POST["email"];

if (empty ($UID) || empty ($f_name) || empty ($l_name) || empty ($email)) {
    $errorMessage = "All the fields are required";
} else {
    $sql = "UPDATE accounts " .
           "SET f_name='$f_name', l_name='$l_name', email='$email' " .
           "WHERE UID = $UID";

    $result = $con->query($sql);

    if (!$result) {
        $errorMessage = "Invalid query" . $con->error;
    } else {
        $successMessage = "Client updated correctly";
    }
}

header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
exit;
?>

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

$UID = "";
$f_name ="";
$l_name="";
$email = "";

$errorMessage ="";
$successMessage ="";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET METHOD

    if ( !isset( $_GET['UID'] ) ) {
        header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
        exit;
    }

    $UID = $_GET["UID"];

    // read row
    $sql ="SELECT * FROM accounts WHERE UID=$UID";
    $result = $con->query($sql);
    $row= $result->fetch_array( );

    if (!$row) {
        header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
        exit;
    }

    $UID = "{$row['UID']}";
    $f_name ="{$row['f_name']}";
    $l_name="{$row['l_name']}";
    $email = "{$row['email']}";

}
else {
    // POST METHOD

    $UID = "{$_POST['UID']}";
    $f_name ="{$_POST['f_name']}";
    $l_name="{$_POST['l_name']}";
    $email = "{$_POST['email']}";

    do {
        if (empty ($UID) || empty ($f_name) || empty ($l_name) || empty ($email)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE accounts " . 
               //"SET UID='$UID', 
               "f_name='$f_name', l_name='$l_name', email='$email' " . 
               "WHERE UID = $UID";

        $result = $con->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $con->error;
            break;
        }

        $successMessage = "Client updated correctly";
        header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
        exit;


    } while (false); 

}
?>
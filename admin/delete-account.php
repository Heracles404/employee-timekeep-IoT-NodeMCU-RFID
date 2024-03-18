<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nodemcu_rfid_iot";

    // Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $sql = "DELETE FROM accounts WHERE UID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    // Execute the statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

header("location: /employee-timekeep-IoT-NodeMCU-RFID/admin/index.php");
exit;
?>

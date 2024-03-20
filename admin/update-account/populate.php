<?php
include_once('../connects.php');

// Check if UID parameter is set
if (isset($_GET['UID'])) {
    $UID = $_GET['UID'];

    // Perform a query to fetch data based on the UID
    $query = "SELECT * FROM accounts WHERE UID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $UID);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data !== null) {
        // Return data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo 'Error: No data found for UID ' . $UID;
    }
} else {
    // If UID parameter is not set, return an error message
    echo 'Error: UID parameter not set';
}
?>

<?php
// Include database connection file
include_once 'connects.php';

// Get UID from the query string
if(isset($_GET['id'])) {
    $uid = $_GET['id'];

    // Generate the CSV file name
    $filename = "employee_{$uid}.csv";

    // Fetch data from the table
    $query = "SELECT * FROM `{$uid}`"; // Enclose table name in backticks
    $result = mysqli_query($con, $query);

    // Create CSV file
    $fp = fopen('php://output', 'w');
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($fp, $row);
    }
    fclose($fp);

    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'"');

    // Output CSV data
    readfile('php://output');
}
?>

<?php
include_once('connects.php');

if (isset($_GET['UID'])) {
    $temp_UID = $_GET['UID'];

    // Check if UID exists in accounts table
    $query = "SELECT * FROM `accounts` WHERE UID = '$temp_UID'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "Not Registered";
    } else {
        // Check if there is a table for the given UID
        $table_name = $temp_UID;
        $check_table_query = "SHOW TABLES LIKE '$table_name'";
        $check_table_result = mysqli_query($con, $check_table_query);

        if (mysqli_num_rows($check_table_result) == 0) {
            echo "Table not initiated. Please clock-in first.";
        } else {
            // Check if there is a time-in record for the current date
            date_default_timezone_set('Asia/Manila');
            $current_date = date('Y-m-d');
            $current_time_ph = date('H:i:s');
            $query = "SELECT * FROM `$table_name` WHERE log_date = '$current_date'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 0) {
                echo "No time-in record found for today.";
            } else {
                // Update the time-out column with the current time
                $update_query = "UPDATE `$table_name` SET time_out = '$current_time_ph' WHERE log_date = '$current_date'";
                mysqli_query($con, $update_query);
                echo "Clock-out successful!";
            }
        }
    }
}
mysqli_close($con);
?>

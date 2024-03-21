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
        // Create table if registered and do not have a table based on UID
        $table_name = $temp_UID;
        $check_table_query = "SHOW TABLES LIKE '$table_name'";
        $check_table_result = mysqli_query($con, $check_table_query);

        if (mysqli_num_rows($check_table_result) == 0) {
            $create_table_query = "CREATE TABLE `$table_name` (
                                    `log_date` VARCHAR(30) PRIMARY KEY,
                                    `time_in` VARCHAR(30),
                                    `time_out` VARCHAR(30)
                                )";
            $create_table_result = mysqli_query($con, $create_table_query);

            if (!$create_table_result) {
                echo "Error creating table: " . mysqli_error($con);
            } else {
                echo "Table initiated!";
                clockIn($temp_UID);
            }
        } else {
            echo "Table already exists!";
            clockIn($temp_UID);
        }
    }
}

// Record Insertion
function clockIn($UID){
    global $con; // Add this line to access the $con variable from the global scope

    // Set timezone to Philippine time
    date_default_timezone_set('Asia/Manila');

    // Get the current date and time in Philippine time
    $current_date = date('Y-m-d');
    $current_time_ph = date('H:i:s');

    // Construct the table name using the UID
    $table_name = mysqli_real_escape_string($con, $UID);

    // Check if there are records for the current date
    $query = "SELECT * FROM `$table_name` WHERE log_date = '$current_date'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 0) {
        // If no records exist for the current date, insert a new record
        $insert_query = "INSERT INTO `$table_name` (log_date, time_in) VALUES ('$current_date', '$current_time_ph')";
        mysqli_query($con, $insert_query);
    }

}

mysqli_close($con);
?>

<?php

include_once('connects.php');

if (isset($_GET['UID'])) {
    $temp_UID = $_GET['UID'];

    // Update the value in the database
    $sql = "UPDATE temp_in SET RFID_UID = '$temp_UID' WHERE idx = 1";

    if (mysqli_query($con, $sql)) {
        $result = mysqli_query($con, "SELECT * FROM temp_in WHERE idx = 1");
        $row = mysqli_fetch_assoc($result);

        // Echo the updated record
        echo $row['RFID_UID'];
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "UID parameter not provided";
}
mysqli_close($con);
?>

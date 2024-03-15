<?php
include_once('connects.php');

$query = "SELECT * FROM `temporary_data`";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error fetching data: " . mysqli_error($con);
} else {
    while ($row = mysqli_fetch_array($result)) {
        echo $row['RFID_UID']; 
    }
}

mysqli_close($con);
?>

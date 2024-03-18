<?php
include_once('../connects.php');

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    // Check if UID exists
    $query = "SELECT * FROM accounts WHERE UID = '$uid'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // UID exists
        echo "UID exists";
    } else {
        // UID does not exist
        echo "UID does not exist";
    }
}
mysqli_close($con);
?>

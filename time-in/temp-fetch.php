<?php
include_once('connects.php');

$query = "SELECT * FROM `temp_in`";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error fetching data: " . mysqli_error($con);
} else {
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $uid = $row['RFID_UID'];
        // Fetch user data
        $query = "SELECT f_name, l_name, picture FROM accounts WHERE UID = '$uid'";
        $userResult = mysqli_query($con, $query);

        if (!$userResult) {
            echo "Error fetching user data: " . mysqli_error($con);

        } else {
            $userData = mysqli_fetch_assoc($userResult);
            if ($userData) {
                // Add user data to the current row
                $row['f_name'] = $userData['f_name'] . ' ' . $userData['l_name'];
                $row['picture'] = base64_encode($userData['picture']);
            }
        }
        $rows[] = $row;
    }
    echo json_encode($rows);
}

mysqli_close($con);
?>

<?php
include_once('connects.php');

$uid = $_GET['uid']; // Assuming the UID is passed as a GET parameter
$rows = array();

$query = "SELECT f_name, l_name, email, picture FROM accounts WHERE UID = '$uid'";
$userResult = mysqli_query($con, $query);

if (!$userResult) {
    echo "Error fetching user data: " . mysqli_error($con);
} else {
    $userData = mysqli_fetch_assoc($userResult);
    if ($userData) {
        // Add user data to the current row
        $row['f_name'] = $userData['f_name'];
        $row['f_name'] = $userData['f_name'];
        $row['l_name'] = $userData['l_name'];
        $row['email'] = $userData['l_name'];
        $row['picture'] = base64_encode($userData['picture']);
    }
    echo json_encode($userData);
}

mysqli_close($con);

?>

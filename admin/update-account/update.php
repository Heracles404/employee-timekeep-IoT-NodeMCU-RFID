<?php
include_once('connects.php'); // Include the file that establishes the database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $UID = $_POST['UID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    // File upload
    $image = $_FILES['image']['tmp_name'];
    if ($image != "") {
        $imgContent = addslashes(file_get_contents($image)); // Store image content
    } else {
        $imgContent = "";
    }

    // Clear 'temporary_data' table
    $query_clear = "UPDATE temporary_data SET RFID_UID = ' ' WHERE idx = 1";
    $con->query($query_clear);

    // Check if UID already exists
    $checkUID = "SELECT * FROM accounts WHERE UID='$UID'";
    $result = $con->query($checkUID);
    if ($result->num_rows < 0) {
        echo "<script>alert('Error: UID does exists.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // Insert data into database
        $sql = "UPDATE accounts SET f_name = '$firstname', l_name = '$lastname', email = '$email', picture = '$imgContent' WHERE UID = '$UID'";

        if ($con->query($sql) === TRUE) {
            // Alert message
            echo "<script>alert('Successfully registered');</script>";
            // Redirect to loader.php with query parameters
            header("Location: ../index.php");
            exit();

        } else {
            // echo "<script>alert('Error: " . $sql . "\\n" . $con->error . "');</script>";

            echo "<script>alert('Error: " . $sql . "\\n" . $con->error . "');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
        }
    }
    $con->close();
}
?>

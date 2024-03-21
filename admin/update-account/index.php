<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nodemcu_rfid_iot";

// Connection
$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection Failed: ". $con->connect_error);
}

$UID = "";
$f_name ="";
$l_name="";
$email = "";
$picture = ""; // Initialize the $picture variable

$errorMessage ="";
$successMessage ="";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET METHOD

    if ( !isset( $_GET['UID'] ) ) {
        header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
        exit;
    }

    $UID = $_GET["UID"];

    // read row
    $sql ="SELECT * FROM accounts WHERE UID=$UID";
    $result = $con->query($sql);
    $row= $result->fetch_array( );

    if (!$row) {
        header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
        exit;
    }

    $UID = "{$row['UID']}";
    $f_name ="{$row['f_name']}";
    $l_name="{$row['l_name']}";
    $email = "{$row['email']}";
    $picture = base64_encode($row['picture']); // Convert BLOB to base64

}
else {
    // POST METHOD

    $UID = "{$_POST['UID']}";
    $f_name ="{$_POST['f_name']}";
    $l_name="{$_POST['l_name']}";
    $email = "{$_POST['email']}";

    do {
        if (empty ($UID) || empty ($f_name) || empty ($l_name) || empty ($email)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE accounts " .
               "SET f_name='$f_name', l_name='$l_name', email='$email' " .
               "WHERE UID = $UID";

        $result = $con->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $con->error;
            break;
        }

        $successMessage = "Client updated correctly";
        header('location: /employee-timekeep-IoT-NodeMCU-RFID/admin/');
        exit;

    } while (false);

}
?>

<!DOCTYPE html>
<html>
<head>
    <!--title-->
    <title>Update</title>
    <!--style-->
    <link rel="stylesheet" href="design/app.css">
    <script src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container">
        <h1>Information Update</h1>

        <form id="registerForm" action="populate.php" method="post" enctype="multipart/form-data">

            <div>
                <div class="form-control" id="imageBox">
                    <img id="uploadedImage" src="data:image/jpeg;base64,<?php echo $picture; ?>">
                </div>

                <div>
                    <input type="file" id="uploadInput" name="image" accept="image/*" onchange="uploadImage()">
                    <label for="uploadInput" class="custom-file-input">Choose File</label>
                </div>
                <br>
            </div>

            <div class="form-control">
                <input type="text" id="UID" name="UID" value="<?php echo $UID;?>" required>
                <label for="UID">UID:</label>
            </div>


            <div class="form-control">
                <input type="text" id="firstname" name="firstname" value="<?php echo $f_name;?>" required>
                <label for="firstname">First Name</label>
            </div>

            <div class="form-control">
                <input type="text" id="lastname" name="lastname" value="<?php echo $l_name;?>" required>
                <label for="lastname">Last Name</label>
            </div>

            <div class="form-control">
                <input type="e-mail" id="email" name="email" value="<?php echo $email;?>" required>
                <label for="email">Email</label>
            </div>

            <div class="form-control btn-container">
               <a href="../index.php">
                 <button type="button" class="btn cancel">Cancel</button>
               </a>
                <button type="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
    <br>

    <script src="design/design.js"></script>
</body>
</html>

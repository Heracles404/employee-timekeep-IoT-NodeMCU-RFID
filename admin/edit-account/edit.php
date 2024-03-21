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

$errorMessage ="";
$successMessage ="";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET METHOD

    if ( isset( $_GET['UID'] ) ) {
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
               //"SET UID='$UID', 
               "f_name='$f_name', l_name='$l_name', email='$email' " . 
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>

        <?php
            if(!empty($errorMessage)) {
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>

        <form method="post">
        <input type="" value="<?php echo $UID;?>"> <!-- ginawang hidden -->
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">UID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="UID" value="<?php echo $UID;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="f_name" value="<?php echo $f_name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="l_name" value="<?php echo $l_name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>           

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="http://localhost/employee-timekeep-IoT-NodeMCU-RFID/admin/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</body>
</html>
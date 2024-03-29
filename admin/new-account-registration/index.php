<?php
include_once('connects.php');

// Clear 'temporary_data' table
$query_clear = "UPDATE temporary_data SET RFID_UID = ' ' WHERE idx = 1";
$con->query($query_clear);

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!--title-->
    <title>Register</title>
    <!--style-->
    <link rel="stylesheet" href="design/app.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="temp-display.js"></script>
</head>

<body>
    <div class="container">
        <h1>Register</h1>

        <form id="registerForm" action="insertData.php" method="post" enctype="multipart/form-data">

            <div>
                <div class="form-control" id="imageBox">
                    <img id="uploadedImage" src="design/img.jpg">
                </div>

                <div>
                    <input type="file" id="uploadInput" name="image" accept="image/*" onchange="uploadImage()">
                    <label for="uploadInput" class="custom-file-input">Choose File</label>
                </div>
                <br>
            </div>

            <div class="form-control">
                <input type="text" id="UID" name="UID" required>
                <label for="UID">UID:</label>
            </div>


            <div class="form-control">
                <input type="text" id="firstname" name="firstname" required>
                <label for="firstname">First Name</label>
            </div>

            <div class="form-control">
                <input type="text" id="lastname" name="lastname" required>
                <label for="lastname">Last Name</label>
            </div>

            <div class="form-control">
                <input type="e-mail" id="email" name="email" required>
                <label for="email">Email</label>
            </div>

            <div class="form-control btn-container">
               <a href="../index.php">
                 <button type="button" class="btn cancel">Cancel</button>
               </a>
                <button type="submit" class="btn">Register</button>
            </div>


        </form>
    </div>
    <br>

    <script src="design/design.js"></script>
</body>
</html>

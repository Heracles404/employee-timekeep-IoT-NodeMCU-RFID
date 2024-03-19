<?php
include_once('connects.php');

// Clear 'temporary_data' table
$query_clear = "UPDATE temp_in SET RFID_UID = ' ' WHERE idx = 1";
$con->query($query_clear);

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!--title-->
    <title>Time In</title>
    <!--style-->
    <link rel="stylesheet" href="design/app.css">
    <link rel="stylesheet" href="clock/clock.css">
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="temp-display.js"></script>
    <script src="clock/clock.js"></script>
</head>

<body>
<div class="container">
    <h2 id="clock"></h2>

    <form id="registerForm" action="time-in.php" method="get" enctype="multipart/form-data">
        <div>
            <div class="form-control" id="imageBox">
                <img id="uploadedImage" src="design/img.jpg">
            </div>
            <br>

            <h1>Time In</h1>

            <div class="form-control">
                <input type="text" id="uid" name="uid" readonly>
            </div>
            <div class="form-control">
                <input type="text" id="name" name="name" readonly>
            </div>
    </form>

</div>

<script src="design/design.js"></script>
</body>
</html>

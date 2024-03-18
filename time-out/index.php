<!DOCTYPE html>
<html>
<head>
    <!--title-->
    <title>Time Out</title>
    <!--style-->
    <link rel="stylesheet" href="design/app.css">
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="temp-display.js"></script>
</head>

<body>
<div class="container">
    <h1>Time Out</h1>

    <form id="registerForm" action="time-out.php" method="get" enctype="multipart/form-data">
        <div>
            <div class="form-control" id="imageBox">
                <img id="uploadedImage" src="design/img.jpg">
            </div>
            <br>
        </div>

        <div class="form-control">
            <input type="text" id="UID" name="UID" readonly>
            <label for="UID">UID</label>
        </div>

        <div class="form-control">
            <input type="text" id="name" name="lastname" readonly>
            <label for="lastname">Name</label>
        </div>
    </form>
</div>
<br>

<script src="design/design.js"></script>
</body>
</html>
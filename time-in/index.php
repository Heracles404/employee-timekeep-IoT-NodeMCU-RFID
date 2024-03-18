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
    <p id="clock"></p>

    <h1>Time In</h1>

    <form id="registerForm" method="get" enctype="multipart/form-data">
        <div>
            <div class="form-control" id="imageBox">
                <img id="uploadedImage" src="design/img.jpg">
            </div>
            <br>
        </div>

        <div class="form-control">
            <input type="text" id="UID" name="UID" onchange="checkUID()" readonly>
            <label for="UID">UID</label>
        </div>

        <div class="form-control">
            <input type="text" id="name" name="name" readonly>
            <label for="lastname">Name</label>
        </div>
    </form>
</div>
<br>


<script src="design/design.js"></script>
<script src="record/authenticate-uid.js"></script>
</body>
</html>
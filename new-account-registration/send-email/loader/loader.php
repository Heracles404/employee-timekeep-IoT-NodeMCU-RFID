<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--icon-->
    <link rel="icon" href="#">
    <!--title-->
    <title>Loading...</title>
    <!--style-->
    <link rel="stylesheet" href="loader.css">
    <!--favicons-->
    <script src="https://kit.fontawesome.com/d1612815b1.js" crossorigin="anonymous"></script>
</head>
<body>
    <br>
    <div class="kinetic"></div>

    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var UID = urlParams.get('UID');
        var firstname = urlParams.get('firstname');
        var lastname = urlParams.get('lastname');
        var email = urlParams.get('email');

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Email sent successfully!");
                window.location.href = "../../index.php"; // Redirect after sending email
            } else if (this.readyState == 4 && this.status != 200) {
                console.error("Error sending email!");
                alert("Error sending email!");
                window.location.href = "../../index.php"; // Redirect on error
            }
        };
        xhr.open("GET", "../send-email.php?UID=" + UID + "&firstname=" + firstname + "&lastname=" + lastname + "&email=" + email, true);
        xhr.send();
    </script>

    <script src="script.js"></script>
</body>
</html>

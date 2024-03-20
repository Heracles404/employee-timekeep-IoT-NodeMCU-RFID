<!DOCTYPE html>
<html lang="en">
<head>
    <!--title-->
    <title>Account Table</title>
    <!--style-->
    <link rel="stylesheet" type="text/css" href="design/design.css">

</head>

<body>
    <h1> Registered Accounts </h1>
        <div class="button-container">
            <a class="btn btn-primary" href="/employee-timekeep-IoT-NodeMCU-RFID/admin/new-account-registration/" role="button">Register New Client</a>
        </div>
        <br><br>

    <!-- Search form -->
    <form action="" method="GET">
        <div class="input-group mb-3">
            <!-- Actual search input with autocomplete disabled -->
            <input type="text" class="form-control" placeholder="Search by First Name, Last Name, or UID" name="search" aria-describedby="button-addon2" id="searchInput">
            <!-- Hidden input to capture autocomplete suggestions -->
            <input type="text" style="display:none;">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
    </form>

    <script>
    // Disable the browser's autocomplete
    document.getElementById("searchInput").setAttribute("autocomplete", "off");
    </script>

    <table class="table">
        <thead>
            <tr>
                <th>UID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // Include search.php file
            include_once('search.php');
            ?>
        </tbody>
    </table>
</body>
</html>
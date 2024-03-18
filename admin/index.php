<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Table</title>
</head>
<body style="margin: 50px;">
    <h1> Registered Accounts </h1>
    <a class="btn btn-primary" href="/employee-timekeep-IoT-NodeMCU-RFID/admin/new-account-registration/" role="button">Register New Client</a>
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
// Disable browser autocomplete
document.getElementById("searchInput").setAttribute("autocomplete", "off");
</script>




    <table class="table">
        <thead>
            <tr>
                <th>UID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nodemcu_rfid_iot";

// Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: ". $conn->connect_error);
}

// Check if search query is set
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Query to search by first name, last name, or UID
    $sql = "SELECT * FROM accounts WHERE f_name LIKE '%$search%' OR l_name LIKE '%$search%' OR UID LIKE '%$search%'";
} else {
    // Default query to fetch all rows
    $sql = "SELECT * FROM accounts";
}

$result = $conn->query($sql);

if (!$result) {
    die("Invalid query". $conn->error);
}

// read data
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['UID']}</td>
            <td>{$row['f_name']}</td>
            <td>{$row['l_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['created_at']}</td>
            <td>
                <a href='/IoT-NodeMCU-RFID/admin/update.php?id={$row['UID']}'>Update</a>
                <a href='/employee-timekeep-IoT-NodeMCU-RFID/admin/account-table/delete-account.php?id={$row['UID']}'>Delete</a>
            </td>
          </tr>";
}
?>
        </tbody>
    </table>
</body>
</html>

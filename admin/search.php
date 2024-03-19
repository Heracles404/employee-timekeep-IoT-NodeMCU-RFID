<?php
include_once('connects.php');

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

// Read data
while ($row = $result->fetch_assoc()) {
    echo "<tr>  
            <td>{$row['UID']}</td>
            <td>{$row['f_name']}</td>
            <td>{$row['l_name']}</td>   
            <td>{$row['email']}</td>
            <td>{$row['created_at']}</td>
            <td>
            <a href='/employee-timekeep-IoT-NodeMCU-RFID/admin/update-account/?id={$row['UID']}'>
            <button>Update</button>
            </a>
            <a href='/employee-timekeep-IoT-NodeMCU-RFID/admin/delete-account/delete-account.php?id={$row['UID']}'>
            <button>Delete</button>
            </a>
        
            </td>
          </tr>";
}
?>
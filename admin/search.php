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

$result = $con->query($sql);

if (!$result) {
    die("Invalid query". $con->error);
}

// Read data
while ($row = $result->fetch_assoc()) {
    echo "<tr>  
            <td>{$row['UID']}</td>
            <td>{$row['f_name']}</td>
            <td>{$row['l_name']}</td>   
            <td>{$row['email']}</td>
            <td>
                <a href='/employee-timekeep-IoT-NodeMCU-RFID/admin/export-timesheet.php?id={$row['UID']}'>
                    <img src='design/export.png' class='icon'/>
                </a>

                <a href='/employee-timekeep-IoT-NodeMCU-RFID/admin/update-account/index.php?UID=({$row['UID']})'>
                    <img src='design/update.png' class='icon'/>
                </a>

                <a href='/employee-timekeep-IoT-NodeMCU-RFID/admin/delete-account/delete-account.php?id={$row['UID']}'>
                    <img src='design/trash.png' class='icon'/>
                </a>
            </td>
          </tr>";
}

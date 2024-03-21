<?php
require_once('../connects.php');

require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the UID is provided
if(isset($_GET['UID'])){
    $UID = $_GET['UID'];

    // Retrieve data from accounts table based on UID
    $query = "SELECT * FROM accounts WHERE UID = '$UID'";
    $result = mysqli_query($con, $query);

    // Check if a user is found with the provided UID
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $firstname = $row['f_name'];
        $lastname = $row['l_name'];
        $email = $row['email'];

        // Set the timezone to Manila, Philippine time
        date_default_timezone_set('Asia/Manila');
        $c_time = date('H:i:s');
        $c_date = date('Y-m-d');

        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->SMTPAuth = true;

            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->Username = "apostle.logistix@gmail.com"; // Replace with your Gmail address
            $mail->Password = "swtnyoofxzvpdmcy"; // Replace with your Gmail password

            $mail->setFrom($email, "Apostle Logistix");
            $mail->addAddress($email, "$firstname $lastname");

            $mail->Subject = "Apostle Logistix: Time In Notification";
            $mail->Body = "
                Dear $firstname $lastname,

                UID: $UID

                You have successfully timed in today, $c_date, at exactly $c_time.

                Have a good day!
                ";

            $mail->send();
            echo "Email sent successfully!";
        } catch (Exception $e) {
             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No user found with UID: $UID";
    }
} else {
    echo "UID not provided";
}
?>

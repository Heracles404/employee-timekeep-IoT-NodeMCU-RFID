<?php

$UID = $_GET['UID'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];

// Set the timezone to Manila, Philippine time
date_default_timezone_set('Asia/Manila');

$c_time = date('H:i:s');
$c_date = date('Y-m-d');

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    $mail->Subject = "Welcome to Apostle Logistix";
    $mail->Body = "
        Dear $firstname $lastname,

        UID: $UID

        You have successfully timed in on today, $c_date, at exactly $c_time.

        Have a good day!
        ";


    $mail->send();
    // Redirect after sending email
//     header("Location: ../index.php");
    exit();
} catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo "<script>alert('Error!')</script>";
//     header("Location: ../index.php");
    exit();
}
?>

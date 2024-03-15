<?php
$UID = $_GET['UID'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];

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
    $mail->addAddress($email, "Someone");

    $mail->Subject = "Welcome to Apostle Logistix";
    $mail->Body = "
    Dear $firstname $lastname,

    Welcome to Apostle Logistix! We are thrilled to have you on board.
    Your UID: $UID has been successfully registered, in which you can use on our time keeping readers.

    As a new member of our community, you can expect top-notch service and support and vice versa.

    Feel free to reach out to us at any time with questions or feedback. We look forward to a successful partnership.

    Best regards,
    Apostle Logistix Team";


    $mail->send();
    header("Location: ../index.php");
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: ../index.php");
    exit();
}
?>

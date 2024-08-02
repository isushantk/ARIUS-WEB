<?php
// Load PHPMailer classes
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Replace these details with your SMTP server settings
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587; // or the appropriate port for your SMTP server
$smtpUsername = 'arius7103@gmail.com';
$smtpPassword = 'ARIUS@2023';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Set up the recipient email address
    $to = "arius7103@gmail.com";

    // Compose the email body
    $emailBody = "
        <h2>New Message from Contact Form</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    ";

    try {
        // Create a new PHPMailer instance
        $mail = new PHPMailer();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->Port = $smtpPort;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        // Uncomment the line below if your SMTP server requires TLS encryption
        // $mail->SMTPSecure = 'tls';

        // Compose the email headers
        $mail->setFrom($email, $name);
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $emailBody;

        // Send the email
        if ($mail->send()) {
            // Email sent successfully
            echo "Message Sent Successfully";
        } else {
            // Email failed to send
            echo "error";
        }
    } catch (Exception $e) {
        // Exception occurred, email failed to send
        echo "error";
    }
}
?>

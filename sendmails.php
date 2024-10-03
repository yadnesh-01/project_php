<?php

// Adjust paths to where you placed the PHPMailer files
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    //Server settings
    $mail->isSMTP();
    $mail->SMTPDebug = 0;  // Enable verbose debug output
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'yadneshsbudukh01@gmail.com';
    $mail->Password = 'zsro mwgm urjt eafo';

    //Recipients
    $mail->setFrom('yadneshsbudukh01@gmail.com');
    $mail->addAddress('yadneshbudukh0904@gmail.com');

    //Content
    $mail->Subject = 'Hello from PHPMailer!';
    $mail->Body    = 'This is a test.';

    // Send the message, check for errors
    $mail->send();
    echo "SUCCESS";
} catch (Exception $e) {
    echo "ERROR: " . $mail->ErrorInfo;
}

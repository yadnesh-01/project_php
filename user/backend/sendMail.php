<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

class SendMails {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        // Mail server settings
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->SMTPAuth = true;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 465;
        $this->mail->Username = 'yadneshsbudukh01@gmail.com';
        $this->mail->Password = 'zsro mwgm urjt eafo'; // App password (due to two-factor authentication)
        $this->mail->setFrom('yadneshsbudukh01@gmail.com', 'Reservation System');
    }

    public function sendToRestaurant($rname, $restinfo_email, $booking) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($restinfo_email);

            $this->mail->Subject = 'New Reservation';
            $this->mail->Body = "Hello {$rname}! You have a new reservation:\n\n"
                . "Customer Name: {$booking['username']}\n"
                . "Contact Number: {$booking['cont']}\n"
                . "Reservation Date: {$booking['res_date']}\n"
                . "Reservation Time: {$booking['res_time']}\n"
                . "Number of People: {$booking['tab_no']}";

            $this->mail->send();
            write_log('SendMails.php', __FILE__, 'SUCCESS', "Reservation email sent to restaurant: {$rname}");
        } catch (Exception $e) {
            write_log('SendMails.php', __FILE__, 'ERROR', "Mailer Error: " . $this->mail->ErrorInfo);
            echo "ERROR: " . $this->mail->ErrorInfo;
        }
    }

    public function sendToCustomer($username, $email, $rname, $res_date,$res_time, $tab_no) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($email);

            $this->mail->Subject = 'Reservation Confirmation';
            $this->mail->Body = "Hello {$username}! Your reservation is successful:\n\n"
                . "Restaurant Name: {$rname}\n"
                . "Reservation Date: {$res_date}\n"
                . "Reservation Time: {$res_time}\n"
                . "Number of People: {$tab_no}\n"
                . "Thank you for choosing us!";

            $this->mail->send();
            write_log('SendMails.php', __FILE__, 'SUCCESS', "Reservation confirmation email sent to customer: {$username}");
        } catch (Exception $e) {
            write_log('SendMails.php', __FILE__, 'ERROR', "Mailer Error: " . $this->mail->ErrorInfo);
            echo "ERROR: " . $this->mail->ErrorInfo;
        }
    }
}
?>

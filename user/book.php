<?php

require 'backend/sendMail.php';

include('../logs/log_writer.php');
include('backend/database.php');

// Start session
session_start();
$page_title = "Booking Page";

try {
    $conn = new Database();

    if (isset($_POST['rname']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['tab_no'])) {
        $uname = $_SESSION['uname'];
        $cont = $_SESSION['cont'];
        $rname = $_POST['rname'];
        $res_date = $_POST['date'];
        $res_time = $_POST['time'];
        $tab_no = $_POST['tab_no'];


        // checks if reservation date is fron the upcoming dates or not if no generate error

        $reservationDate = new DateTime($res_date);
        $currentDate = new DateTime();

        if ($reservationDate < $currentDate->setTime(0, 0, 0)) {
            write_log('book.php', __FILE__, 'ERROR', 'Reservation date is in the past.');
            die("Error: You cannot make a reservation for a past date.");
        }

        // Check if table is available
        $sql_check = "SELECT * FROM reservations WHERE rname = ? AND res_date = ? AND res_time = ? AND tab_no = ?";
        $stmt_check = $conn->prepare($sql_check);

        if ($stmt_check === false) {
            write_log('book.php', __FILE__, 'ERROR', "Error preparing statement: " . $conn->error);
            die("Error preparing statement: " . $conn->error);
        }

        $stmt_check->bind_param("ssss", $rname, $res_date, $res_time, $tab_no);
        if (!$stmt_check->execute()) {
            write_log('book.php', __FILE__, 'ERROR', "Error executing query: " . $stmt_check->error);
            die("Error executing query: " . $stmt_check->error);
        }

        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) 
        {
            write_log('book.php', __FILE__, 'INFO', 'Table already booked.');
            echo "The table is already booked for the selected restaurant, date, and time.";
        } else 
        {
            // Check if the user exists in userinfo table
            $sql_user = "SELECT * FROM userinfo WHERE uname = ?";
            $stmt_user = $conn->prepare($sql_user);

            if ($stmt_user === false) {
                write_log('book.php', __FILE__, 'ERROR', "Error preparing statement: " . $conn->error);
                die("Error preparing statement: " . $conn->error);
            }

            $stmt_user->bind_param("s", $uname);
            if (!$stmt_user->execute()) {
                write_log('book.php', __FILE__, 'ERROR', "Error executing query: " . $stmt_user->error);
                die("Error executing query: " . $stmt_user->error);
            }

            $result_user = $stmt_user->get_result();

            $booking = $result_user->fetch_assoc();


                $sql_insert = "INSERT INTO reservations (username, cont, rname, res_date, res_time, tab_no) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);

                if ($stmt_insert === false) {
                    write_log('book.php', __FILE__, 'ERROR', "Error preparing statement: " . $conn->error);
                    die("Error preparing statement: " . $conn->error);
                }

                $stmt_insert->bind_param("sssssi", $uname, $cont, $rname, $res_date, $res_time, $tab_no);

                if ($stmt_insert->execute()) {
                    $reservation_id = $conn->insert_id;
                    write_log('book.php', __FILE__, 'SUCCESS', 'Reservation successful. ID: ' . $reservation_id);
                    echo "Reservation successful! Your reservation ID is: " . $reservation_id;

                    $sql_email = "SELECT email FROM restinfo WHERE rname = ?";
                        $stmt_email = $conn->prepare($sql_email);
                        $stmt_email->bind_param("s", $rname);
                        $stmt_email->execute();
                        $stmt_email->bind_result($restinfo_email);
                        $stmt_email->fetch();
                
                    $mailer = new SendMails();
                $mailer->sendToRestaurant($rname,$restinfo_email,[
                    'username'=>$booking['username'],
                    'cont'=>$cont,
                    'res_date'=>$res_date,
                    'res_time'=>$res_time,
                    'tab_no'=>$tab_no
                ]);

                $mailer->sendToCustomer($booking['username'], $booking['email'], $rname, $res_date,$res_time, $tab_no);
                } else 
                {
                        write_log('book.php', __FILE__, 'ERROR', "Error executing query: " . $stmt_insert->error);
                        echo "Error: " . $stmt_insert->error;
                }
        } 
    }
} catch (Exception $e) 
{
    write_log('book.php', __FILE__, 'ERROR', $e->getMessage());
    echo "An unexpected error occurred. Please try again later.";
    $conn->close();
}



?>


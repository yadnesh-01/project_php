<?php
include('../logs/log_writer.php');
include('backend/database.php');
// Start session
session_start();

try {

    $conn = new Database();
    
    write_log('logintab.php',__FILE__,'SUCCESS',"Connection Successful");

    if (isset($_POST['login_btn'])) {
        $uname = $_POST['uname'];
        $upass = $_POST['upass'];

        // Query to check credentials
        $sql = "SELECT * FROM userinfo WHERE uname = ?";
        $stmt = $conn->prepare($sql);

        // Catching 

        $stmt->bind_param("s", $uname);

        // Identifying issues during query execution and preventing silent failure
        if (!$stmt->execute()) {
            write_log('logintab.php',__FILE__,'ERROR',"SQL Execution Error");
            throw new Exception("Error executing query: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error getting result: " );
        }

        // For successful login handling
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Use password_verify to check the password
            if (password_verify($upass, $user['upass'])) {
                echo("logged in successfully");
                write_log('logintab.php',__FILE__,'SUCCESS', $uname." User Logged In Successfuly");
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['uname'] = $user['uname'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['cont'] = $user['cont'];
                header("Location: dashboard.php");
                exit();
            } else {
                write_log('logintab.php',__FILE__,'Warning',"Entered Username or Password Does not match");
                echo "<script> alert('Wrong username or password'); window.location.href='login.php'; </script>";
                exit();
            }
        } else {
            write_log('logintab.php',__FILE__,'Warning',"Entered Username or Password Does not match");
            echo "<script> alert('Wrong username or password'); window.location.href='login.php'; </script>";
            exit();
        }
    }
} catch (Exception $e) {
    write_log('logintab.php',__FILE__,'ERROR',"". $e->getMessage());
    echo "An error occurred: " . $e->getMessage();
} finally {
    // Close connection
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>

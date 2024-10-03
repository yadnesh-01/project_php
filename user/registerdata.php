<?php
include('backend/database.php');

try {
    // Database connection
    $conn= new Database();

    if (isset($_POST['username']) && isset($_POST['cont']) && isset($_POST['uname']) && isset($_POST['upass']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $cont = $_POST['cont'];
        $uname = $_POST['uname'];
        $upass = $_POST['upass'];
        $email = $_POST['email'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($upass !== $confirm_password) {
            throw new Exception("Passwords do not match.");
        }

        // Hash the password using password_hash()
        $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

        // Check if uname and email already exist
        $sql = "SELECT * FROM userinfo WHERE uname = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $uname, $email);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception("Get result failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            // Username or email already exists
            echo "<script>alert('Username or email already exists');</script>";
            echo "<script>window.location.href='register.php';</script>";
        } else {
            // Insert data into userinfo table
            $sql = "INSERT INTO userinfo (username, uname, cont, upass, email) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("sssss", $username, $uname, $cont, $hashed_password, $email);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Registration successful');</script>";
                echo "<script>window.location.href='login.php';</script>";
            } else {
                throw new Exception("Registration failed.");
            }
        }
    } else {
        throw new Exception("All fields are required.");
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    echo "<script>window.location.href='register.php';</script>";
} finally {
    // Close connection
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>

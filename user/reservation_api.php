<?php
include('authentication.php');
include('backend/database.php');

try {
    // Initialize the database connection
    $conn= new Database();

    // Get the request method
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Handle the DELETE request to delete a reservation
    if ($requestMethod === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
        $id = $_POST['id'];

        // Prepare the SQL statement to delete the reservation
        $sql = "DELETE FROM reservations WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to delete reservation: " . $stmt->error);
        }

        echo "Reservation deleted successfully";
        http_response_code(200);
        $stmt->close();
    }

    // Handle the PUT request to update a reservation
    if ($requestMethod === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
        $id = $_POST['id'];
        $res_date = $_POST['res_date'];
        $res_time = $_POST['res_time'];
        $tab_no = $_POST['tab_no'];

        // Convert provided date to DateTime object
        $reservationDate = new DateTime($res_date);
        $currentDate = new DateTime(); // Current date and time

        // Check if the reservation date is in the past
        if ($reservationDate < $currentDate->setTime(0, 0, 0)) {
            throw new Exception("Error: You cannot make a reservation for a past date.");
        } 

        // Prepare the SQL statement to update the reservation
        $sql = "UPDATE reservations SET res_date = ?, res_time = ?, tab_no = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssii", $res_date, $res_time, $tab_no, $id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update reservation: " . $stmt->error);
        }

        echo "Reservation updated successfully";
        http_response_code(200);
        $stmt->close();
    }
} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
    http_response_code(500);
} finally {
    // Close connection
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>

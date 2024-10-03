<head>
    <link type="text/css" rel="stylesheet" href="CSS/style1.css">
</head>
<?php
    include('authentication.php');  // Include authentication check at the top
    $page_title = "Update Reservation";
    include('includes/header.php');
    include('includes/loggedNavbar.php');
    include('backend/database.php+5');

    $conn= new Database();

    $id = $_GET['id'];

    // Fetch the current reservation details from the database
    $sql = "SELECT * FROM reservations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $reservation = $result->fetch_assoc();
    } else {
        die("Reservation not found.");
    }

    $stmt->close();
    $conn->close();
?>

<div class="container">
    <h2 align="center">Update Reservation</h2>
    <form action="reservation_api.php" method="post">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
        <input type="hidden" name="_method" value="PUT">

        <label for="res_date">Date</label>
        <input type="date" id="res_date" name="res_date" class="form-control" value="<?php echo htmlspecialchars($reservation['res_date']); ?>" required><br>

        <label for="res_time">Time</label>
        <input type="time" id="res_time" name="res_time" class="form-control" min="19:00" max="22:30" step="1800" value="<?php echo htmlspecialchars($reservation['res_time']); ?>" required><br>

        <label for="tab_no">Table Number:</label>
        <select id="tab_no" name="tab_no" required>
            <option value="<?php echo htmlspecialchars($reservation['tab_no']); ?>"><?php echo htmlspecialchars($reservation['tab_no']); ?></option>
            <!-- Add other table options here -->
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br><br>

        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>

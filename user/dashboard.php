<?php
include('authentication.php'); 
$page_title = "Dashboard";
include('includes/header.php');
include('../logs/log_writer.php');
include('includes/loggedNavbar.php');
include('backend/database.php');

// Fetch the user's information
$username = $_SESSION['uname'];
$uname = $_SESSION['username'];
$cont = $_SESSION['cont'];

try { 
    $conn= new Database();

    // Query to fetch booking details for the logged-in user
    $sql = "SELECT r.id, ri.rname, ri.rcontact, ri.radd, r.res_date, r.res_time, r.tab_no 
            FROM restinfo ri 
            JOIN reservations r ON ri.rname = r.rname 
            WHERE r.username = ?
            ORDER BY r.res_date ASC, r.res_time ASC";
    
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

} catch (Exception $e) {
    write_log('dashboard.php',__FILE__,'ERROR',"".$e->getMessage());
    echo "An error occurred: " . $e->getMessage();
    $conn->close();
    exit();
}
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5>User Dashboard</h5>
                </div>
                <div class="card-body">
                    <h3>Welcome, <?php echo htmlspecialchars($uname); ?>!</h3>
                    <p>Contact: <?php echo htmlspecialchars($cont); ?></p>
                    
                    <?php if ($result->num_rows > 0) { ?>
                        <h4>Your Bookings:</h4>
                        <a href="previous_reservations.php" class="btn btn-primary">Previous Bookings</a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Booking Id</th>
                                        <th>Restaurant Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Table No.</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    while ($booking = $result->fetch_assoc()) { 
                                        $reservationDate = new DateTime($booking['res_date']);
                                        $currentDate = new DateTime();
                                        if ($reservationDate >= $currentDate->setTime(0, 0, 0)) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($booking['id']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['rname']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['rcontact']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['radd']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['res_date']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['res_time']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['tab_no']); ?></td>
                                            <td>
                                                <!-- <?php if ($reservationDate >= $currentDate->setTime(0, 0, 0)) { ?> -->
                                                    <a href="update_reservation.php?id=<?php echo $booking['id']; ?>" class="btn btn-primary">Update</a>
                                                    <form action="reservation_api.php" method="post" style="display:inline;">
                                                        <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</button>
                                                    </form>
                                                <!-- <?php } else { ?>
                                                    <p>No actions available</p>
                                                <?php } ?> -->
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } write_log('dashboard.php',__FILE__,'INFO',"Reservation Displayed Successfuly");?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p>You have no bookings yet.</p>
                    <?php write_log('dashboard.php',__FILE__,'INFO',$uname." Not have any reservation");} ?>
                </div>
            </div>
        </div>
    </div>
</div>
                
<?php 
include('includes/footer.php'); 

// Close the statement and connection
$stmt->close();
$conn->close();
?>

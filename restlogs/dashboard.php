<?php
include('authentication.php');  // Include authentication check at the top
$page_title = "Dashboard";
include('includes/header.php');
include('includes/loggedNavbar.php');

// Fetch the restaurants information

$rname=$_SESSION['rname'];
$rcontact = $_SESSION['rcontact']; 

// Initialize the database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "rest_book";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch booking details for the logged-in user
$sql = "select r.id, u.username, u.cont, r.res_date, r.res_time, r.tab_no from userinfo u join reservations r on u.uname=r.username where r.rname=? ORDER BY r.res_date ASC, r.res_time ASC";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("s", $rname);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5>Restaurant Dashboard</h5>
                </div>
                <div class="card-body">
                    <h3>Welcome, <?php echo htmlspecialchars($rname); ?>!</h3>
                    <p>Contact: <?php echo htmlspecialchars($rcontact); ?></p>
                    
                    <?php if ($result->num_rows > 0) { ?>
                        <h4>Your Bookings:</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Booking Id</th>
                                        <th>Customers Name</th>
                                        <th>Customers Contact</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Table No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($booking = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($booking['id']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['username']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['cont']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['res_date']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['res_time']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['tab_no']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p>You have no bookings yet.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
                        
<?php include('includes/footer.php'); ?>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>

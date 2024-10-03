<?php
session_start();
include('../logs/log_writer.php');

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to access this page.";
    header('Location: login.php');
    exit(0);
}
write_log('book1.php',__FILE__,'SUCCESS',"Accessed Booking Page");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="CSS/style1.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Restaurant Booking</title>
    <style>
       
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" >Restaurant Booking </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="book1.php">Book Now</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

<form calss="space" id="foodForm" action="book.php" method="post">

    <label for="rname">Restaurant :</label>
    <select type="text" id="rname" name="rname" required>
      <option></option>
      <option value="Am - Pm Chinese Couisine">Am - Pm Chinese Couisine</option>
      <option value="Gavhane's Mutton">Gavhane's Mutton</option>
      <option value="Sarangi: Pure Veg">Sarangi Pure veg</option>
    </select>


    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br>
    


    <label for="time">Choose a time:</label>
     <input type="time" id="time" name="time" min="19:00" max="22:30" step="1800" required>

    <label for="tab_no">Table Number:</label>
    <select id="tab_no" name="tab_no" required>
        <option value="0">Select table number</option>
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
    </select>
<br> <br>
    <input type="submit" value="Book Now">
</form>

<!-- Table Number and Their Occupency -->
<h4 class="space">(reffer following table to know the number of sittings)</h4>
<table class="space" class="table" >
    <tr style="text-align: left;">
        <th>Table No. </th>
        <th>Occupency</th>
    </tr>
    <tr>
        <td>1, 2</td>
        <td>2 People </td>
    </tr>
    <tr>
        <td>3, 4, 5, 6 </td>
        <td>4 People</td>
    </tr>
    <tr>
        <td>7, 8 </td>
        <td>8 People</td>
    </tr>
    <tr>
        <td>9, 10</td>
        <td>12 People</td>
    </tr>
</table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

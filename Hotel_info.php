<?php
include "config.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$cust_id = $_GET['cust_id'] ?? '';
$hotelId = $_GET['hotel_id'] ?? '';

$sql = "SELECT * FROM HOTEL_INFO WHERE Hotel_id = '$hotelId'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $hotelInfo = mysqli_fetch_assoc($result);
} else {
    $hotelInfo = [];
}

$sql = "SELECT * FROM CLASSIC WHERE Hotel_id = '$hotelId'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $classicRooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $classicRooms = [];
}

$sql = "SELECT * FROM DELUXE WHERE Hotel_id = '$hotelId'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $deluxeRooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $deluxeRooms = [];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Information</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h2>Hotel Information</h2>

    <h3>Hotel Details</h3>
    <?php if (!empty($hotelInfo)) : ?>
      <p><strong>Hotel ID:</strong> <?php echo $hotelInfo['Hotel_id']; ?></p>
      <p><strong>Hotel Name:</strong> <?php echo $hotelInfo['Hotel_name']; ?></p>
      <p><strong>Hotel Address:</strong> <?php echo $hotelInfo['H_address']; ?></p>
      <p><strong>Facilities:</strong> <?php echo $hotelInfo['facilities']; ?></p>
    <?php else : ?>
      <p>No information available for this hotel.</p>
    <?php endif; ?>

    <h3>Classic Rooms</h3>
    <?php if (!empty($classicRooms)) : ?>
      <table class="table">
        <thead>
          <tr>
            <th>Room Number</th>
            <th>Price</th>
            <th>Status</th>
            <th>Capacity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($classicRooms as $room) : ?>
            <tr>
              <td><?php echo $room['room_no']; ?></td>
              <td><?php echo $room['price']; ?></td>
              <td><?php echo $room['status']; ?></td>
              <td><?php echo $room['capacity']; ?></td>
              <td><a href="reservation.php?room_id=<?php echo $room['room_no']; ?>&cust_id=<?php echo $cust_id; ?>" class="btn btn-primary">Book Room</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <p>No classic rooms available for this hotel.</p>
    <?php endif; ?>

    <h3>Deluxe Rooms</h3>
    <?php if (!empty($deluxeRooms)) : ?>
      <table class="table">
        <thead>
          <tr>
            <th>Room Number</th>
            <th>Price</th>
            <th>Status</th>
            <th>Capacity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($deluxeRooms as $room) : ?>
            <tr>
              <td><?php echo $room['room_no']; ?></td>
              <td><?php echo $room['price']; ?></td>
              <td><?php echo $room['status']; ?></td>
              <td><?php echo $room['capacity']; ?></td>
              <td><a href="reservation.php?room_id=<?php echo $room['room_no']; ?>&cust_id=<?php echo $cust_id; ?>" class="btn btn-primary">Book Room</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <p>No deluxe rooms available for this hotel.</p>
    <?php endif; ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>



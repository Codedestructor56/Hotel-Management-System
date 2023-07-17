<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 400px;
      margin: 50px auto;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn {
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Hotel Registration Form</h2>
    <form action="hotel_insertion.php" method="POST">
      <div class="form-group">
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" class="form-control" id="hotel_name" name="hotel_name" required>
      </div>
      <div class="form-group">
        <label for="hotel_address">Hotel Address:</label>
        <input type="text" class="form-control" id="hotel_address" name="hotel_address" required>
      </div>
      <div class="form-group">
        <label for="facilities">Facilities:</label>
        <input type="text" class="form-control" id="facilities" name="facilities">
      </div>
      <div class="form-group">
        <label for="contact_no">Contact Number:</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no" required>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<?php

include "admin_config.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hotelName = $_POST['hotel_name'] ?? '';
    $hotelAddress = $_POST['hotel_address'] ?? '';
    $facilities = $_POST['facilities'] ?? '';
    $contactNo = $_POST['contact_no'] ?? '';

    function conn($conn, $stmt) {
        if (!mysqli_query($conn, $stmt)) {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }

    $sequence_insert = "INSERT INTO seq_hotel VALUES (NULL)";
    conn($conn, $sequence_insert);
    $hotel_id = mysqli_insert_id($conn) ?? '';

    $hotelInfoInsert = "INSERT INTO HOTEL_INFO (Hotel_id, Hotel_name, H_address, facilities) VALUES ('$hotel_id', '$hotelName', '$hotelAddress', '$facilities')";
    conn($conn, $hotelInfoInsert);

    $hotelInsert = "INSERT INTO HOTEL (Hotel_id, H_contactno) VALUES ('$hotel_id', '$contactNo')";
    conn($conn, $hotelInsert);

    unset($hotelName);
    unset($hotelAddress);
    unset($facilities);
    unset($contactNo);

    header("Location: hotel_insertion.php");
    exit();
}
?>


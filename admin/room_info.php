<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Room Information</title>
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
    <h2>Add Room Information</h2>
    <form action="room_info.php" method="POST">
      <div class="form-group">
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" class="form-control" id="hotel_name" name="hotel_name" required>
      </div>
      <div class="form-group">
        <label for="room_type">Room Type:</label>
        <select class="form-control" id="room_type" name="room_type">
          <option value="classic">Classic</option>
          <option value="deluxe">Deluxe</option>
        </select>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" class="form-control" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
          <option value="booked">booked</option>
          <option value="vacant">vacant</option>
        </select>
      </div>
      <div class="form-group">
        <label for="capacity">Capacity:</label>
        <input type="text" class="form-control" id="capacity" name="capacity" required>
      </div>
      <button type="submit" class="btn btn-primary">Add Room</button>
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
    $roomType = $_POST['room_type'] ?? '';
    $price = $_POST['price'] ?? '';
    $status = $_POST['status'] ?? '';
    $capacity = $_POST['capacity'] ?? '';

    function conn($conn, $stmt) {
        if (!mysqli_query($conn, $stmt)) {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
    $hotelIdQuery = "SELECT hotel_id FROM HOTEL_INFO WHERE Hotel_name = '$hotelName'";
    $result = mysqli_query($conn, $hotelIdQuery);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hotelId = $row['hotel_id'];
        $sequence_insert = "INSERT INTO room_seq VALUES (NULL)";
        conn($conn, $sequence_insert);
        $room_no = mysqli_insert_id($conn);
        $roomInsert = "";
        if ($roomType === "classic") {
            $roomInsert = "INSERT INTO CLASSIC (room_no, price, status, capacity, hotel_id) VALUES ('$room_no', '$price', '$status', '$capacity', '$hotelId')";
        } elseif ($roomType === "deluxe") {
            $roomInsert = "INSERT INTO DELUXE (room_no, price, status, capacity, hotel_id) VALUES ('$room_no', '$price', '$status', '$capacity', '$hotelId')";
        }
        $room_info_insert= "INSERT INTO ROOM_INFO(room_id,room_type) VALUES ('$room_no','$roomType')";
        if ($roomInsert) {
            conn($conn, $roomInsert);

            conn($conn,$room_info_insert);
            unset($hotelName);
            unset($roomNo);
            unset($roomType);
            unset($price);
            unset($status);
            unset($capacity);

            header("Location: room_info.php");
            exit();
        } else {
            echo "Invalid room type.";
        }
    } else {
        echo "No hotel found with the given name.";
    }
}
?>



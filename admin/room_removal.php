<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Room Information</title>
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
    <h2>Delete Room Information</h2>
    <form action="room_removal.php" method="POST">
      <div class="form-group">
        <label for="room_no">Room Number:</label>
        <input type="text" class="form-control" id="room_no" name="room_no" required>
      </div>
      <div class="form-group">
        <label for="room_type">Room Type:</label>
        <select class="form-control" id="room_type" name="room_type">
          <option value="classic">Classic</option>
          <option value="deluxe">Deluxe</option>
        </select>
      </div>
      <button type="submit" class="btn btn-danger">Delete Room</button>
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
    $roomNo = $_POST['room_no'] ?? '';
    $roomType = $_POST['room_type'] ?? '';

    function conn($conn, $stmt) {
        if (!mysqli_query($conn, $stmt)) {
            echo "Error deleting data: " . mysqli_error($conn);
        }
    }

    if ($roomType === "classic") {
        $roomDelete = "DELETE FROM CLASSIC WHERE room_no = '$roomNo';";
    } elseif ($roomType === "deluxe") {
        $roomDelete = "DELETE FROM DELUXE WHERE room_no = '$roomNo';";
    }

    conn($conn, $roomDelete);

    unset($roomNo);
    unset($roomType);

    header("Location: room_removal.php");
    exit();
}
?>

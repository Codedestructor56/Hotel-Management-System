<?php
include "config.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$room_id = $_GET['room_id'] ?? '';
$cust_id= $_GET['cust_id'] ?? '';

$sql = "SELECT capacity AS no_of_guests FROM CLASSIC WHERE room_no = '$room_id' UNION ALL SELECT capacity AS no_of_guests FROM DELUXE WHERE room_no = '$room_id'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $no_of_guests_row = mysqli_fetch_assoc($result);
    $no_of_guests = $no_of_guests_row['no_of_guests'];
} else {
    $no_of_guests = 0; 
}
$price1="SELECT price FROM (SELECT price FROM CLASSIC WHERE room_no = '$room_id' UNION ALL SELECT price FROM DELUXE WHERE room_no = '$room_id') AS prices";
$result1= mysqli_query($conn,$price1);
if ($result1 && mysqli_num_rows($result1) > 0) {
    $price_row = mysqli_fetch_assoc($result1);
    $price = $price_row['price'];
} else {
    $price = 0; 
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $check_in_date = $_POST['check_in_date'] ?? '';
    $check_out_date = $_POST['check_out_date'] ?? '';
    $no_of_guests = $_POST['no_of_guests'] ?? '';
    $payment_status = $_POST['payment_status'] ?? '';

    function conn($conn,$stmt){
        if (!mysqli_query($conn, $stmt)) {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
    $updateClassicStatus = "UPDATE CLASSIC SET status = 'booked' WHERE room_no = '$room_id'";
    mysqli_query($conn, $updateClassicStatus);

    $updateDeluxeStatus = "UPDATE DELUXE SET status = 'booked' WHERE room_no = '$room_id'";
    mysqli_query($conn, $updateDeluxeStatus);

    $status1="SELECT status FROM CLASSIC WHERE room_no = '$room_id' UNION ALL SELECT status FROM DELUXE WHERE room_no = '$room_id'";
    $result2= mysqli_query($conn,$status1);
    if ($result1 && mysqli_num_rows($result2) > 0) {
        $status_row = mysqli_fetch_assoc($result2);
        $status = $status_row['status'];
    } else {
        $status = 0; 
    }

    $sequence_insert = "INSERT INTO seq_res VALUES (NULL)";
    conn($conn, $sequence_insert);
    $res_id = mysqli_insert_id($conn);

    $sql = "SELECT * FROM room_info WHERE room_id = '$room_id'";
    $result = mysqli_query($conn, $sql);

    /*just testing if room id actually works:
      if ($result && mysqli_num_rows($result) > 0) {
        $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $rooms = [];
    }
    foreach($rooms as $i){
      echo $i['room_type'];
    }*/

    $sequence_insert1 = "INSERT INTO seq_service VALUES (NULL)";
    conn($conn, $sequence_insert1);
    $service_id = mysqli_insert_id($conn);

    $reservationInsert = "INSERT INTO RESERVATION (res_id, room_id, check_out_date, check_in_date, no_of_guests, payment_status) VALUES ('$res_id','$room_id', '$check_out_date', '$check_in_date', '$no_of_guests', '$payment_status')";
    mysqli_query($conn, $reservationInsert);

    $serviceInsert = "INSERT INTO SERVICE (res_id, service_id, s_name, s_price, availability, des) VALUES ('$res_id', '$service_id', 'room', '$price', '$status', 'Service Description')";
    mysqli_query($conn, $serviceInsert);


    header("Location: success.php?room_id=$room_id&cust_id=$cust_id");
    exit();
}


mysqli_close($conn); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h2>Reservation</h2>
    <form action="reservation.php?room_id=<?php echo $room_id; ?>&cust_id=<?php echo $cust_id?>" method="POST">
      <div class="form-group">
        <label for="check_in_date">Check-in Date:</label>
        <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
      </div>
      <div class="form-group">
        <label for="check_out_date">Check-out Date:</label>
        <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
      </div>
      <div class="form-group">
        <label for="no_of_guests">Number of Guests:</label>
        <input type="number" class="form-control" id="no_of_guests" name="no_of_guests" required max=<?php echo $no_of_guests?> min=0>
      </div>
      <div class="form-group">
        <label for="payment_status">Payment Status:</label>
        <select class="form-control" id="payment_status" name="payment_status" required>
          <option value="Paid">Paid</option>
          <option value="Pending">Pending</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Make Reservation</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

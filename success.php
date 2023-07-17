<?php
include "config.php";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$cust_id = $_GET['cust_id'] ?? '';
$room_id = $_GET['room_id'] ?? '';


$customerInfoQuery = "SELECT * FROM GUEST_INFO WHERE cust_id = '$cust_id'";
$customerInfoResult = mysqli_query($conn, $customerInfoQuery);
$customerInfo = mysqli_fetch_assoc($customerInfoResult);

$roomInfoQuery = "SELECT * FROM CLASSIC WHERE room_no = '$room_id' UNION ALL SELECT * FROM DELUXE WHERE room_no = '$room_id'";
$roomInfoResult = mysqli_query($conn, $roomInfoQuery);
$roomInfo = mysqli_fetch_assoc($roomInfoResult);

mysqli_close($conn); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Success</h2>
        <h3>Customer Information</h3>
        <?php if (!empty($customerInfo)) : ?>
            <p><strong>Customer Name:</strong> <?php echo $customerInfo['F_name']." ".$customerInfo['L_name']; ?></p>
            
         
        <?php else : ?>
            <p>No customer information found.</p>
        <?php endif; ?>

        <h3>Room Information</h3>
        <?php if (!empty($roomInfo)) : ?>
            <p><strong>Room ID:</strong> <?php echo $roomInfo['room_no']; ?></p>
            <p><strong>Room Price:</strong> <?php echo $roomInfo['price']; ?></p>
            <p><strong>Room Status:</strong> <?php echo $roomInfo['status']; ?></p>
            
        <?php else : ?>
            <p>No room information found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>


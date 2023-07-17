<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
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
    <h2>Signup Form</h2>
    <form action="signup.php" method="POST">
      <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
      </div>
      <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
      </div>
      <div class="form-group">
        <label for="contact">Contact Number:</label>
        <input type="tel" class="form-control" id="contact" name="contact" required>
      </div>
      <div class="form-group">
        <label for="payment_info">Payment Info:</label>
        <input type="text" class="form-control" id="payment_info" name="payment_info" required>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" class="form-control" id="dob" name="dob" required>
      </div>

      <div class="form-group">
        <label for="cnic">CNIC:</label>
        <input type="text" class="form-control" id="cnic" name="cnic" required>
      </div>
      <div class="form-group">
        <label for="purpose">Purpose of Visit:</label>
        <select class="form-control" id="purpose" name="purpose">
          <option value="Business">Business</option>
          <option value="Normal">Normal</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Signup</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
include "config.php";

// Create a new mysqli connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}    

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $payment_info = $_POST['payment_info'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $cnic = $_POST['cnic'] ?? '';
    $purpose=$_POST['purpose'] ?? '';
    $phone=$_POST['phone'] ?? '';

    function calculateAge($dob) {
        if (empty($dob)) {
            return null;
        }

        $today = new DateTime();
        $birthDate = DateTime::createFromFormat('Y-m-d', $dob);

        $diff = $today->diff($birthDate);

        return $diff->y;
    }
    
    $age = calculateAge($dob);
    function conn($conn,$stmt){
        if (!mysqli_query($conn, $stmt)) {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
    

    $dob_g_insert = "INSERT INTO dob_g (age, dob) VALUES ('$age', '$dob')";
    conn($conn,$dob_g_insert);
 
    $sequence_insert = "INSERT INTO Sequence VALUES (NULL)";
    conn($conn, $sequence_insert);
    $cust_id = mysqli_insert_id($conn);

    $guest_info_insert = "INSERT INTO GUEST_INFO (cust_id, F_name, L_name, payment_info, DOB, CNIC)
                          VALUES ('$cust_id', '$first_name', '$last_name', '$payment_info', '$dob', '$cnic')";
    conn($conn, $guest_info_insert);
  
    $guest_insert="INSERT INTO GUEST (cust_id, phoneno)
    VALUES ('$cust_id','$contact')";
    conn($conn,$guest_insert);
    if($purpose=="Business"){
        $dob_bg_insert="INSERT INTO dob_bg (age, dob) VALUES ('$age', '$dob')";
        conn($conn,$dob_bg_insert);
        $bg_info="INSERT INTO BUSINESS_GUEST_INFO (cust_id, F_name, L_name, payment_info, DOB, NTN)
        VALUES ('$cust_id', '$first_name', '$last_name', '$payment_info', '$dob', '$cnic')";
        conn($conn,$bg_info);
        $bg_insert="INSERT INTO BUSINESS_GUEST (cust_id, phoneno)
        VALUES ('$cust_id','$contact')";
        conn($conn,$bg_insert);
    }
    unset($first_name);
    unset($last_name);
    unset($contact);
    unset($payment_info);
    unset($dob);
    unset($cnic);
    unset($purpose);
    unset($phone);
    header("Location: signin.php");
}
?>

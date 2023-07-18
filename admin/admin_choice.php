<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }

    .card {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="text-center mb-5">Admin Panel</h2>
    <div class="row">
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Insert Hotel Information</h5>
            <p class="card-text">Add details about a new hotel.</p>
            <a href="hotel_insertion.php" class="btn btn-primary btn-block">Go to Hotel Insertion</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Insert Room Information</h5>
            <p class="card-text">Add details about a new room.</p>
            <a href="room_info.php" class="btn btn-primary btn-block">Go to Room Insertion</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Insert Employee Information</h5>
            <p class="card-text">Add details about a new employee.</p>
            <a href="employee_info.php" class="btn btn-primary btn-block">Go to Employee Insertion</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Delete Room Information</h5>
            <p class="card-text">Delete a room.</p>
            <a href="room_removal.php" class="btn btn-primary btn-block">Go to Room Deletion</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Delete Employee Information</h5>
            <p class="card-text">Remove an employee.</p>
            <a href="employee_removal.php" class="btn btn-primary btn-block">Go to Employee Removal</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>




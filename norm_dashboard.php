<?php
include "config.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$cust_id=$_GET['cust_id'] ?? '';

$sql = "SELECT Hotel_id, Hotel_name FROM HOTEL_INFO";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $hotels = [];
}

if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
    $filteredHotels = array_filter($hotels, function($hotel) use ($searchQuery) {
        return stripos($hotel['Hotel_name'], $searchQuery) !== false;
    });
} else {
    $filteredHotels = $hotels;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    html,
    body {
      height: 100%;
    }

    .container {
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .search-bar {
      margin-bottom: 20px;
    }

    .hotel-list {
      padding: 0;
      flex-grow: 1;
      overflow-y: auto;
    }

    .hotel-list button {
      display: block;
      width: 100%;
      text-align: left;
      margin-bottom: 10px;
    }

    .hotel-name {
      font-weight: bold;
      font-size: 20px;
      margin-bottom: 5px;
    }

    .hotel-description {
      color: #666;
    }
  </style>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
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
    <form method="POST" action="norm_dashboard.php">
      <div class="search-bar">
        <input type="text" class="form-control" name="search" placeholder="Search..."
          value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
        <button type="submit" class="btn btn-primary" >Search</button>
      </div>
    </form>
    <div class="hotel-list">
      <?php if (count($filteredHotels) > 0) : ?>
        <?php foreach ($filteredHotels as $hotel) : ?>
          <button class="btn btn-light" onclick="redirectToHotelInfo(<?php echo $hotel['Hotel_id']; ?>)">
            <div class="hotel-name"><?php echo $hotel['Hotel_name']; ?></div>
          </button>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="text-center">No hotels found.</div>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    function redirectToHotelInfo(hotelId) {
      <?php if ($cust_id !== '') : ?>
        window.location.href = "hotel_info.php?hotel_id=" + hotelId + "&cust_id=<?php echo $cust_id; ?>";
      <?php else : ?>
        window.location.href = "norm_hotel_info.php?hotel_id=" + hotelId;
      <?php endif; ?>
    }
  </script>
</body>

</html>





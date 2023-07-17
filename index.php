
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOTEL MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .navbar {
      background-color: #f8f9fa;
    }
    .navbar .nav-item {
      margin-right: 10px;
    }
    .navbar .nav-item:last-child {
      margin-right: 0;
    }
    .dropdown-toggle:hover + .dropdown-menu {
      display: block;
    }
    .dropdown-menu {
      right: 0;
      left: auto;
      transition: opacity 0.2s ease-in-out;
    }
    .dropdown-menu.show {
      opacity: 1;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
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
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="optionsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Options
          </a>
          <div class="dropdown-menu" aria-labelledby="optionsDropdown">
            <a class="dropdown-item" href="signin.php">Sign In</a>
            <a class="dropdown-item" href="signup.php">Sign Up</a>
            <a class="dropdown-item" href="norm_dashboard.php">View as Guest</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- write page content here ammar-->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>



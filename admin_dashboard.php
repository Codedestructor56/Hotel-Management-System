<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn {
      width: 100%;
      padding: 10px;
      font-weight: bold;
    }

    .error-message {
      color: red;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="text-center">Admin Login</h2>
    <form method="post" action="admin/admin_choice.php">
      <div class="form-group">
        <label for="secretKey">Secret Key:</label>
        <input type="password" class="form-control" id="secretKey" name="secretKey" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      <?php
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $secretKey = $_POST['secretKey'] ?? '';
        if ($secretKey === 'rgba34') {
          // Redirect to admin panel or perform further actions
          header("Location: admin/admin_choice.php");
          exit();
        } else {
          echo '<div class="error-message">Invalid secret key. Please try again.</div>';
        }
      }
      ?>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

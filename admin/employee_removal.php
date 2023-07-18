<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Employee</h2>
        <form action="employee_removal.php" method="POST">
            <div class="form-group">
                <label for="e_name">Employee Name:</label>
                <input type="text" class="form-control" id="e_name" name="e_name" required>
            </div>
            <div class="form-group">
                <label for="e_contact">Employee Contact:</label>
                <input type="text" class="form-control" id="e_contact" name="e_contact" required>
            </div>
            <button type="submit" class="btn btn-danger">Delete Employee</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<?php
include "admin_config.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function conn($conn, $stmt) {
    if (!mysqli_query($conn, $stmt)) {
        echo "Error deleting data: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $e_name = $_POST['e_name'] ?? '';
    $e_contact = $_POST['e_contact'] ?? '';

    $employeeIdQuery = "SELECT Employee.emp_id FROM EMPLOYEE_INFO INNER JOIN EMPLOYEE ON EMPLOYEE_INFO.emp_id = EMPLOYEE.emp_id 
                        WHERE e_name = '$e_name' AND e_contact = '$e_contact'";
    $result = mysqli_query($conn, $employeeIdQuery);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $empId = $row['emp_id'];

        $employeeDelete = "DELETE FROM EMPLOYEE WHERE emp_id = '$empId';";
        conn($conn, $employeeDelete);

        $employeeInfoDelete = "DELETE FROM EMPLOYEE_INFO WHERE emp_id = '$empId';";
        conn($conn, $employeeInfoDelete);

        unset($e_name);
        unset($e_contact);

        header("Location: employee_removal.php");
        exit();
    } else {
        echo "No employee found with the given name and contact.";
    }
}

mysqli_close($conn); 
?>


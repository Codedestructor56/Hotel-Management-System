<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information Insertion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Employee Information</h2>
        <form action="employee_info.php" method="POST">
            <div class="form-group">
                <label for="e_name">Employee Name:</label>
                <input type="text" class="form-control" id="e_name" name="e_name" required>
            </div>
            <div class="form-group">
                <label for="position">Position:</label>
                <select class="form-control" id="position" name="position" required>
                    <option value="">Select Position</option>
                    <option value="Manager">Manager</option>
                    <option value="Front Desk Staff">Front Desk Staff</option>
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Waitstaff">Waitstaff</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="text" class="form-control" id="salary" name="salary" required>
            </div>
            <div class="form-group">
                <label for="e_contact">Employee Contact:</label>
                <input type="text" class="form-control" id="e_contact" name="e_contact" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
function conn($conn,$stmt){
    if (!mysqli_query($conn, $stmt)) {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $e_name = $_POST['e_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $salary = $_POST['salary'] ?? '';
    $e_contact = $_POST['e_contact'] ?? '';

    $emp_sequence_insert = "INSERT INTO emp_seq VALUES (NULL)";
    conn($conn, $emp_sequence_insert);
    $emp_id = mysqli_insert_id($conn);

    $employeeInfoInsert = "INSERT INTO EMPLOYEE_INFO (emp_id, e_name, position, salary) VALUES ('$emp_id', '$e_name', '$position', '$salary')";
    mysqli_query($conn, $employeeInfoInsert);

    $employeeInsert = "INSERT INTO EMPLOYEE (emp_id, e_contact) VALUES ('$emp_id', '$e_contact')";
    mysqli_query($conn, $employeeInsert);

    header("Location: employee_info.php");
    exit();
}

mysqli_close($conn); 
?>


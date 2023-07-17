<?php
include "config.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function sanitizeInput($conn, $input)
{
    return mysqli_real_escape_string($conn, trim($input));
}

$nsbmt=false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["cnic"])) {
        $CNIC = sanitizeInput($conn, $_POST["cnic"]);
        $CNIC=(string)$CNIC;
        echo "cnic: ".$CNIC;
        
        $stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM GUEST_INFO WHERE CNIC=?");
        mysqli_stmt_bind_param($stmt, "s", $CNIC);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $rowCount);
        mysqli_stmt_fetch($stmt);
        mysqli_close($conn);
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $stmt2=mysqli_prepare($conn, "SELECT CUST_ID FROM GUEST_INFO WHERE CNIC=?");
        mysqli_stmt_bind_param($stmt2, "s", $CNIC);
        mysqli_stmt_execute($stmt2);
        
        mysqli_stmt_bind_result($stmt2, $cust_id);
        mysqli_stmt_fetch($stmt2);
        if ($rowCount > 0) {
            mysqli_stmt_close($stmt); 
            mysqli_close($conn); 
            header("Location: norm_dashboard.php?cust_id=$cust_id");
            exit();
        } else {
            $nsbmt = true;
        }
    }
}

?>

<!DOCTYPE html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Sign In</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="cnic" id="cnic" placeholder="CNIC" required>
                <button type="submit">Sign In</button>
            </form>
            <?php
                if($nsbmt){
                    echo "Invalid login credentials. Please sign up <a href='signup.php'>here</a>.";
                }
           
            ?>
        </div>
    </div>
</body>

<?php
include('db.php');
require_once "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['input'];

    // Search by chassis number or plate number
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$input' OR plate_number = '$input'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();
        
        echo "<h3>Rider Information</h3>";
        echo "Name: " . $rider['name'] . "<br>";
        echo "Chassis Number: " . $rider['chassis_number'] . "<br>";
        echo "Plate Number: " . $rider['plate_number'] . "<br>";
        echo "Payment Status: " . $rider['payment_status'] . "<br>";
        
        if ($rider['payment_status'] === 'not_paid') {
            echo "<h4>Make Payment</h4>";
            echo "<form method='post' action='process_payment.php'>";
            echo "<input type='hidden' name='chassis_number' value='" . $rider['chassis_number'] . "'>";
            echo "<input type='submit' value='Pay Now'>";
            echo "</form>";
        } else {
            echo "<h4>Payment already made for this month.</h4>";
        }
    } else {
        echo "No rider found with this chassis or plate number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>
    <h2>Check Payment Status</h2>
    <form method="post">
        Enter Chassis or Plate Number: <input type="text" name="input" required>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

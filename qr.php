<?php
include('db.php');
require_once "header.php";
$title="My QR Code";
require_once "navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['input'];
    
    // Search by chassis number or plate number
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$input' OR plate_number = '$input'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();
        $qrFilePath = 'qrcodes/' . $rider['chassis_number'] . '.png';

        if (file_exists($qrFilePath)) {
            echo "<h3>QR Code for {$rider['name']}:</h3>";
            echo "<img src='$qrFilePath' alt='QR Code'><br>";
            echo "<a href='$qrFilePath' download>Download QR Code</a>";
        } else {
            echo "QR code not generated yet.";
        }
    } else {
        echo "No rider found with this chassis or plate number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Download QR Code</title>
</head>
<body>
    <h2>Download Your QR Code</h2>
    <form method="post">
        Enter Chassis or Plate Number: <input type="text" name="input" required>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
include('db.php');
require('qrcode/lib/qrlib.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chassis_number = $_POST['chassis_number'];

    // Fetch rider details from the database
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$chassis_number'";
    $result = $conn->query($sql);
    $rider = $result->fetch_assoc();

    // QR code data (Name, Chassis, Plate number, Payment Status)
    $qrData = "Name: " . $rider['name'] . "\n" .
              "Chassis Number: " . $rider['chassis_number'] . "\n" .
              "Plate Number: " . $rider['plate_number'] . "\n" .
              "Payment Status: " . $rider['payment_status'];

    // Generate and save QR code
    $fileName = 'qrcodes/' . $rider['chassis_number'] . '.png';
    QRcode::png($qrData, $fileName);

    echo "<h3>QR Code for {$rider['name']}:</h3>";
    echo "<img src='$fileName'>";
}
?>

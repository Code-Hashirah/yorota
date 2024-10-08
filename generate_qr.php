<?php
require_once "db.php";
require_once "header.php";
require_once "navbar.php";
require('qrcodes/lib/qrlib.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chassis_number = $_POST['chassis_number'];

    // Fetch rider details from the database
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$chassis_number'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();
        
        // Generate a URL pointing directly to the payment.php page with chassis number as a query parameter
        $ip_address = "192.168.43.19"; // Replace with your PC's IP address
        $project_folder = "yorota"; // Change to your project folder name
        $qrData = "http://$ip_address/$project_folder/payment.php?chassis_number=" . $rider['chassis_number'];

        // Generate and save QR code with the URL
        $fileName = 'qrcodes/' . $rider['chassis_number'] . '.png';
        QRcode::png($qrData, $fileName);

        echo "<h3>QR Code for {$rider['name']}:</h3>";
        echo "<img src='$fileName' alt='QR Code'><br><br>";
    } else {
        echo "No rider found with this chassis number.";
    }
}
?>

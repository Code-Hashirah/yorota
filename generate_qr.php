<?php
  require_once "header.php";
  require_once "db.php";
  require_once "navbar.php";
  require('qrcodes/lib/qrlib.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chassis_number = $_POST['chassis_number'];

    // Fetch rider details from the database
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$chassis_number'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();
        
        // QR code data (Name, Chassis Number, Plate Number, Payment Status)
        $qrData = "Name: " . $rider['name'] . "\n" .
                  "Chassis Number: " . $rider['chassis_number'] . "\n" .
                  "Plate Number: " . $rider['plate_number'] . "\n" .
                  "Payment Status: " . $rider['payment_status'];

        // Generate and save QR code
        $fileName = 'qrcodes/' . $rider['chassis_number'] . '.png';
        QRcode::png($qrData, $fileName);

        echo "<h3>QR Code for {$rider['name']}:</h3>";
        echo "<img src='$fileName' alt='QR Code'><br><br>";

        // Check payment status
        if ($rider['payment_status'] == 'not_paid') {
            // Display payment button linking to payment.php
            echo "<h4>Payment Status: Not Paid</h4>";
            echo "<form action='payment.php' method='POST'>";
            echo "<input type='hidden' name='input' value='" . $rider['chassis_number'] . "'>";
            echo "<input type='submit' value='Pay Now'>";
            echo "</form>";
        } else {
            echo "<h4>Payment Status: Paid</h4>";
        }
    } else {
        echo "No rider found with this chassis number.";
    }
}
?>

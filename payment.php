<?php
require_once "db.php";

if (isset($_GET['chassis_number'])) {
    $chassis_number = $_GET['chassis_number'];

    // Fetch rider details from the database
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$chassis_number'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();

        // Display rider details
        echo "<h2>Rider Details</h2>";
        echo "<p><strong>Name:</strong> " . $rider['name'] . "</p>";
        echo "<p><strong>Plate Number:</strong> " . $rider['plate_number'] . "</p>";
        echo "<p><strong>Chassis Number:</strong> " . $rider['chassis_number'] . "</p>";
        echo "<p><strong>Payment Status:</strong> " . $rider['payment_status'] . "</p>";
        
        // Display rider picture
        if (!empty($rider['picture'])) {
            echo "<img src='uploads/" . $rider['picture'] . "' alt='Rider Picture' style='width:200px;height:200px;'><br>";
        } else {
            echo "<p>No picture available for this rider.</p>";
        }

        // Show payment button if not paid
        if ($rider['payment_status'] == 'not_paid') {
            echo "<h4>Payment Status: Not Paid</h4>";
            // Display payment button linking to process_payment.php
            echo "<form action='process_payment.php' method='POST'>";
            echo "<input type='hidden' name='chassis_number' value='" . $rider['chassis_number'] . "'>";
            echo "<input type='submit' value='Proceed to Payment'>";
            echo "</form>";
        } else {
            echo "<h4>Payment Status: Paid</h4>";
        }
    } else {
        echo "No rider found with this chassis number.";
    }
}
 else {
    echo "No chassis number provided.";
}

?>

<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chassis_number = $_POST['chassis_number'];

    // Update payment status to 'paid'
    $sql = "UPDATE tricycle_riders SET payment_status = 'paid' WHERE chassis_number = '$chassis_number'";

    if ($conn->query($sql) === TRUE) {
        echo "Payment successfully made!";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

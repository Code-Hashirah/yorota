<?php
require_once "db.php";

// Paystack Secret Key
$paystack_secret_key = "sk_test_e4b2508dc7b8eb0714b707e26fd8e68d64601023";

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    // Verify the payment with Paystack
    $url = "https://api.paystack.co/transaction/verify/" . rawurlencode($reference);

    // Initialize cURL session to verify transaction
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $paystack_secret_key",
        "Cache-Control: no-cache",
    ));

    // Execute request and get response
    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);

    // If payment was successful, update the payment status in the database
    if ($response_data['status'] && $response_data['data']['status'] == 'success') {
        $sql = "UPDATE tricycle_riders SET payment_status = 'paid' WHERE chassis_number = '$reference'";
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Payment successful!</h2>";
            echo "<p>Thank you for your payment. Transaction reference: " . $reference . "</p>";
        } else {
            echo "<p>Payment successful, but failed to update the database.</p>";
        }
    } else {
        echo "<h2>Payment failed or was not verified.</h2>";
    }
} else {
    echo "<p>No payment reference found.</p>";
}
?>

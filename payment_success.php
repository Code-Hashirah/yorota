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
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Point cURL to the downloaded CA bundle
    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cacert.pem"); // Path to the downloaded cacert.pem

    // Execute request and get response
// Execute request and get response
$response = curl_exec($ch);

// Print raw cURL response for debugging
if ($response === false) {
    echo "<p>cURL Error: " . curl_error($ch) . "</p>";
} else {
    // echo "<pre>Raw cURL Response: " . $response . "</pre>";
}
// curl_close($ch);
    
    curl_close($ch);

    // Decode the JSON response from Paystack
    $response_data = json_decode($response, true);

    // Debugging: Print the decoded response data after decoding
    echo "<pre class='text-success'>";
    // print_r($response_data);
    echo "</pre>";

    // Check if the request was successful
    if ($response_data['status']) {
        // Check if the payment was successful
        if ($response_data['data']['status'] == 'success') {
            $chassis_number = $reference; // Assuming reference matches chassis_number

            // Securely update the payment status in the database using prepared statement
            $stmt = $conn->prepare("UPDATE tricycle_riders SET payment_status = 'paid' WHERE chassis_number = ?");
            $stmt->bind_param("s", $chassis_number);
            
            if ($stmt->execute()) {
                echo "<h2>Payment successful!</h2>";
                echo "<p class='text-success text-bg-warning'>Thank you for your payment. Transaction reference: " . $reference . "</p>";
                header("location:index.php");
            } else {
                echo "<p>Payment successful, but failed to update the database. Error: " . $conn->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<h2>Payment failed or not verified.</h2>";
            echo "<p>Status: " . $response_data['data']['status'] . "</p>";
        }
    } else {
        echo "<h2>Failed to verify the transaction with Paystack.</h2>";
        echo "<p>Error: " . $response_data['message'] . "</p>";
        echo "<pre>" . print_r($response_data, true) . "</pre>"; // Print full response for debugging
    }
} else {
    echo "<p>No payment reference found.</p>";
}
?>

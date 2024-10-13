<?php
require_once "db.php";

// Paystack API keys
$paystack_public_key = "pk_test_81f2231dcf0b911e432e220d5b0d62697e4a18c0";
$paystack_secret_key = "sk_test_e4b2508dc7b8eb0714b707e26fd8e68d64601023";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chassis_number = $_POST['chassis_number'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tricycle_riders WHERE chassis_number = ?");
    $stmt->bind_param("s", $chassis_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();

        // Rider's email (or generate a placeholder email if not available)
        $email = !empty($rider['email']) ? $rider['email'] : 'rider_' . $rider['chassis_number'] . '@example.com';
        $amount = $_POST['amount'] * 100; // Payment amount in kobo (Naira * 100)
        $reference = $chassis_number. '_' . date('Ym'); // Unique transaction reference

        // Paystack API endpoint to initialize the transaction
        $url = "https://api.paystack.co/transaction/initialize";

        // Prepare the data for Paystack
        $fields = [
            'email' => $email,
            'amount' => $amount,
            'reference' => $reference,
            'callback_url' => "localhost:8080/yorota/payment_success.php?reference={$reference}" // Update to match your domain
        ];

        $fields_string = http_build_query($fields);

        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $paystack_secret_key", // Use variable here
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Point cURL to the downloaded CA bundle
        curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cacert.pem"); // Path to the downloaded cacert.pem

        // Execute the request
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            $curl_error = curl_error($ch);
            echo "cURL Error: " . $curl_error; // Display cURL error
        } else {
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
            $response_data = json_decode($response, true);

            // Check if the request was successful
            if ($http_code == 200 && $response_data['status']) {
                header('Location: ' . $response_data['data']['authorization_url']);
                exit();
            } else {
                echo "Failed to initiate payment.<br>";
                echo "HTTP Code: " . $http_code . "<br>"; // Display HTTP status code
                echo "Error: " . $response_data['message'] . "<br>"; // Display Paystack error message
                print_r($response_data); // Print full response for debugging
            }
        }

        curl_close($ch);
    } else {
        echo "Rider not found.";
    }
}
?>

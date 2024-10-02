<?php
require_once "db.php";

// Paystack API keys
$paystack_public_key = "your_public_key";
$paystack_secret_key = "your_secret_key";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chassis_number = $_POST['chassis_number'];
    
    // Fetch rider details from the database
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$chassis_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();

        // Rider's email (or generate a placeholder email if not available)
        $email = !empty($rider['email']) ? $rider['email'] : 'rider_' . $rider['chassis_number'] . '@example.com';
        $amount = 1000 * 100; // Payment amount in kobo (Naira * 100)
        $reference = $chassis_number; // Unique transaction reference
        
        // Paystack API endpoint to initialize the transaction
        $url = "https://api.paystack.co/transaction/initialize";
        
        // Prepare the data for Paystack
        $fields = [
            'email' => $email,
            'amount' => $amount,
            'reference' => $reference,
            'callback_url' => "localhost:8080/yorota/payment_success.php?reference={$reference}"
        ];

        $fields_string = http_build_query($fields);

        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $paystack_secret_key",
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request and capture the response
        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        // If successful, redirect to Paystack payment page
        if ($response_data['status']) {
            header('Location: ' . $response_data['data']['authorization_url']);
            exit();
        } else {
            echo "Failed to initiate payment. Please try again.";
        }
    } else {
        echo "Rider not found.";
    }
}
?>

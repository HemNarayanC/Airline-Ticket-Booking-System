<?php
session_start();
$curl = curl_init();

$data = array(
    "return_url" => "http://localhost/airline-ticket-booking-system/payment/paymentConfirmation.php",
    "website_url" => "http://localhost/airline-ticket-booking-system/pages/flightSearch.php",
    "amount" => $_SESSION['totalPrice'] * 100, // Amount in paisa (multiplied by 100)
    "purchase_order_id" => "Order01",
    "purchase_order_name" => "test",
    "customer_info" => array(
        "name" => $_SESSION['user-name'],
        "email" => $_SESSION['user-type-email'],
        "phone" => '9800000000'
    )
);

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        'Authorization: key 0d9203628e674a2b93f84dcd74f19a0b', // Khalti API key
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    echo 'Error: ' . curl_error($curl);
} else {
    $responseArray = json_decode($response, true);

    // If payment initiation is successful, store the response and redirect
    if (isset($responseArray['payment_url'])) {
        $_SESSION['response'] = $responseArray;  // Store response in session
        $paymentUrl = $responseArray['payment_url'];  // Extract the payment URL

        // Redirect to the payment URL first
        header("Location: " . $paymentUrl);
        exit();
    } else {
        echo 'Payment initiation failed. Please try again.';
    }
}

curl_close($curl);
?>

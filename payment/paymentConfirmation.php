

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paymentConfirmation.css">
    <title>Payment Completed</title>
</head>
<body>
<?php
    session_start();
    if (!empty($_SESSION['response']['pidx']) && !empty($_SESSION['response']['payment_url'])) {
        // Mark the payment as successful in the session
        $_SESSION['payment_status'] = 'success';
        $_SESSION['payment_response'] = $_SESSION['response']; 
    }

    if($_SESSION['payment_status'] == 'success'){
        echo '
            <div class="card">
        <div class="content">
            <div class="check-container">
                <div class="background-shapes">
                    <div class="circle-bg"></div>
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                </div>
                <div class="check-circle">
                    <span class="checkmark">✓</span>
                </div>
            </div>
            <div class="text-content">
                <h1>Payment Completed</h1>
                <p>Thank you for purchasing via Khalti Payment Gateway! Your payment has been confirmed successfully.</p>
            </div>
        </div>
    </div>';
    }
?>
    <script>
        setTimeout(function() {
            window.location.href = "../pages/ticket.php";  
        }, 2000);
</script>
</body>
</html>


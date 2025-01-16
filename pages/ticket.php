<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyBooker Flight Tickets</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ticket-styles.css">
    <link rel="stylesheet" href="../assets/navbar.css">
</head>
<body>
    <?php
        session_start();
        include('../partials/_navbar.php');
    ?>
    <div class="container">
        <h1 class="main-title">Your Flight Tickets</h1>
        <div class="tickets-container">
            <?php
                include 'generate-ticket.php';
            ?>
        </div>
    </div>
</body>
</html>
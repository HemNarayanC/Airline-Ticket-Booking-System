<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        include '../partials/_navbar.php';
    ?>

    <div class="login-container">
        <div class="login-wrapper">
            <h1>Welcome Back</h1>

            <form action="loginDB.php" id="login-form" class="login-form active" method="post">
                <div class="input-group">
                    <input type="email" name="email" id="user-email" required placeholder=" ">
                    <label for="user-email">Email</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="user-password" required placeholder=" ">
                    <label for="user-password">Password</label>
                </div>

                <div class="checkbox">
                    <input type="checkbox" id="remember-me" name="remember_me">
                    <label for="remember-me">Remember Me</label>
                </div>

                <button type="submit" class="submit-btn">Login</button>
            </form>

            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </div>
    </div>

    <script src="../assets/navbar.js"></script>
    <script src="signup.js"></script>
</body>
</html>

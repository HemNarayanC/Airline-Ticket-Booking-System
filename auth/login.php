<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your Website Name</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
        include '../partials/_navbar.php';
    ?>

    <div class="login-container">
        <div class="login-wrapper">
            <h1>Sign In to Your Account</h1>
            
            <div class="user-type-tabs">
                <button class="tab-btn active" data-user-type="user">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                </button>
                <button class="tab-btn" data-user-type="airline">
                    <i class="fas fa-plane-departure"></i>
                    <span>Airline</span>
                </button>
                <button class="tab-btn" data-user-type="admin">
                    <i class="fas fa-shield-alt"></i>
                    <span>Admin</span>
                </button>
            </div>

            <form action="loginDB.php" id="login-form" class="login-form" method="post">
                <input type="hidden" name="user_type" id="user-type-input" value="user">
                
                <div class="input-group">
                    <input type="email" name="email" id="user-email" required placeholder=" ">
                    <label for="user-email">Email Address</label>
                    <div class="error-message" id="email-error">Please enter a valid email address</div>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="user-password" required placeholder=" ">
                    <label for="user-password">Password</label>
                    <div class="error-message" id="password-error">Password must be at least 3 characters</div>
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
    <script src="login.js"></script>
</body>
</html>

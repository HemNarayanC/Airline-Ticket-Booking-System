<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="s.css">
    <!-- <link rel="stylesheet" href="signup01.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        include '../partials/navbar/_navbar.php';
    ?>

    <div class="signup-container">
        <div class="signup-wrapper">
            <h1>Create an Account</h1>
            
            <form action="signup.php" id="passenger-form" class="signup-from active" method="post">
                <h2>Passenger Sign Up</h2>
                <div class="input-group">
                    <input type="text" name="fname" id="passenger-fname" required>
                    <label for="passenger-fname">First Name</label>
                </div>

                <div class="input-group">
                    <input type="text" name="mid_name" id="passenger-mid-name">
                    <label for="passenger-mid-name">Middle Name</label>
                </div>

                <div class="input-group">
                    <input type="text" name="lname" id="passenger-lname" required>
                    <label for="passenger-lname">Last Name</label>
                </div>

                <div class="input-group">
                    <input type="email" name="email" id="passenger-email" required>
                    <label for="passenger-email">Email</label>
                </div>

                <div class="input-group">
                    <input type="password" name="pw" id="passenger-password" required>
                    <label for="passenger-password">Password</label>
                </div>

                <div class="input-group">
                    <input type="password" name="cpw" id="passenger-cpassword" required>
                    <label for="passenger-cpassword">Confirm Password</label>
                </div>

                <button type="submit" class="submit-btn">Sign Up</button>
            </form>

            <form action="signup.php" id="airline-form" class="signup-form" method="post">
                <h2>Airline Sign Up</h2>
                <div class="input-group">
                    <input type="text" id="registration_number" name="registration_number" placeholder="Enter registration number" required>
                    <label for="registration_number">Registration Number:</label>
                </div>
                
                <div class="input-group">
                    <input type="text" name="company-name" id="airline-company-name" required>
                    <label for="airline-company-name">Company Name</label>
                </div>

                <div class="input-group">
                    <input type="email" name="email" id="airline-email">
                    <label for="airline-email">Email</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="airline-passsword">
                    <label for="airline-password">Password</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="confirm-passsword">
                    <label for="confirm-password">Confirm Password</label>
                </div>

                <div class="input-group">
                    <input type="checkbox" id="accept_terms" name="accept_terms" required>
                    <label for="accept_terms">
                        I agree to the 
                        <a href="terms.html" target="_blank">Terms and Conditions</a>
                    </label>
                <div>

                <button type="submit" class="submit-btn">Sign Up</button>
            </form>
        </div>
    </div>

    <script src="../assets/js/navbar.js"></script>
    <script src="signup.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <?php
        include '../partials/_navbar.php';
    ?>

    <div class="signup-container">
        <div class="signup-wrapper">
            <h1>Create an Account</h1>

            <div class="passenger-form-wrapper">
                <form action="signupDB.php?form=passenger" id="passenger-form" class="signup-form" method="post">
                    <h2>Passenger Sign Up</h2>
                    <div class="input-group">
                        <input type="text" name="fname" id="passenger-fname" placeholder="Enter First Name" required>
                        <label for="passenger-fname">First Name</label>
                    </div>

                    <div class="input-group">
                        <input type="text" name="mid_name" id="passenger-mid-name" placeholder="Middle Name">
                        <label for="passenger-mid-name">Middle Name</label>
                    </div>

                    <div class="input-group">
                        <input type="text" name="lname" id="passenger-lname" required placeholder="Last Name" required>
                        <label for="passenger-lname">Last Name</label>
                    </div>

                    <div class="input-group">
                        <input type="tel" name="phone" id="passenger-phone" placeholder="+CCC-XXXXXXXXXX" required>
                        <label for="passenger-phone">Phone</label>
                    </div>

                    <div class="input-group">
                        <input type="email" name="email" id="passenger-email" placeholder="info@gmail.com" required>
                        <label for="passenger-email">Email</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="pw" id="passenger-password" placeholder="Enter Your Password" required>
                        <label for="passenger-password">Password</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="c_pw" id="passenger-cpassword" placeholder="Confirm Your Password" required>
                        <label for="passenger-cpassword">Confirm Password</label>
                    </div>

                    <button type="submit" class="submit-btn">Sign Up</button>
                </form>
            </div>

            <div class="airline-form-wrapper">
                <form action="registerAirlineDB.php?form=airline" id="airline-form" class="signup-form" method="post">
                    <h2>Airline Sign Up</h2>
                    <div class="input-group">
                        <input type="text" id="registration_number" name="registration_number" placeholder="Registration No." required>
                        <label for="registration_number">Registration Number:</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" name="company-name" id="airline-company-name" placeholder="Enter Company Name" required>
                        <label for="airline-company-name">Company Name</label>
                    </div>

                    <div class="input-group">
                        <input type="tel" name="phone" id="passenger-phone" placeholder="+CCC-XXXXXXXXXX" required>
                        <label for="passenger-phone">Phone</label>
                    </div>

                    <div class="input-group">
                        <input type="email" name="email" id="airline-email" placeholder="info@yourcompany.com" required>
                        <label for="airline-email">Email</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" id="airline-passsword" placeholder="Enter Your Password" required>
                        <label for="airline-password">Password</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="c_pw" id="passenger-cpassword" placeholder="Confirm Your Password" required>
                        <label for="passenger-cpassword">Confirm Password</label>
                    </div>

                    <div class="input-group">
                        <textarea id="airline-address" name="address"></textarea>
                        <label for="airline-address">Address</label>
                    </div>

                    <button type="submit" class="submit-btn">Sign Up</button>
                </form>
            </div>

        </div>
    </div>
    <script src="../assets/navbar.js"></script>
    <script src="signup.js"></script>
</body>
</html>
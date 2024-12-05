
   
   <?php

    session_start();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
        $loggedIn = true;
    }

    else{
        $loggedIn = false;
    }
   
   
   
   echo '<nav class="navbar">
        <div class="navbar-container">

            <!-- logo container -->
            <div class="logo">
                <a href="/">
                    SkyBooker
                    <!-- <img src="../../uploads/logo.png" alt="company_logo"> -->
                </a>
            </div>

            <!-- Nav Menu-->
             <div class="nav-menu-container">
                <ul class="nav-menu-list">
                    <li class="nav-item"><a href="../pages/home.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Book a Flight</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Check-in</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Flight Status</a></li>
                    <li class="nav-item"><a href="../admin/adminDashboard.php" class="nav-link">Dashboard</a></li>
                </ul>
             </div>

            <!--User Actions-->
            <div class="user-actions">';
            
            if(!$loggedIn){
                //<!-- login-btn -->
                echo'<button class="login-btn">
                    <a href="login.php" class="">Login</a>
                </button>';
            }

            if(!$loggedIn){
                   //<!-- signup btn -->
                echo'<div class="singup-container">
                    <button id="signupBtn" class="signup-btn">Sign Up</button>
                    <div id="userTypeDropdown" class="dropdown-content">
                        <a href="signup.php?type=admin" id="adminLink" class="user-type">Admin</a>
                        <a href="signup.php?type=airline" id="airlineLink" class="user-type">Airline</a>
                        <a href="signup.php?type=passenger" id="passengerLink" class="user-type">Passenger</a>
                    </div>
                </div>';
            }

            if($loggedIn){
               // <!-- logout btn -->
              echo '<button class="logout-btn">
                    <a href="../auth/logout.php" class="">Log Out</a>
                </button>';
            }

            echo'</div>
        </div>
    </nav>'
    // <!-- <script src="../../assets/js/navbar.js"></script> -->'

    ?>
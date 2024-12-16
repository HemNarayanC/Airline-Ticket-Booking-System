
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include ('../partials/_db_connect.php');
        $userEmail = $_POST['email'];
        $password = $_POST['password'];

        //passenger sql query
        $sqlPassengerCheck = "SELECT * FROM `users` WHERE `email` = '$userEmail'";
        $resultPassenger = mysqli_query($conn, $sqlPassengerCheck);

         //Airline sql query
         $sqlAirlineCheck = "SELECT * FROM `airline` WHERE `email` = '$userEmail'";
         $resultAirline = mysqli_query($conn, $sqlAirlineCheck);

        //Admin sql query
        $sqlAdminCheck = "SELECT * FROM `admin` WHERE `email` = '$userEmail'";
        $resultAdmin = mysqli_query($conn, $sqlAdminCheck);

        //Passenger Login
        if($resultPassenger && mysqli_num_rows($resultPassenger)==1){
            while($row=mysqli_fetch_assoc($resultPassenger)){
                if(password_verify($password, $row['password'])){
                    session_start();
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['email'] = $userEmail;
                    echo "Successfully Logged In";
                    header('Location: ../pages/flightSearch.php');

                    // exit();
                }

                else{
                    echo "Password didn't match";
                }
            }

        }

        //login for airline
        elseif ($resultAirline && mysqli_num_rows($resultAirline) == 1) {
            # code...
            while($row=mysqli_fetch_assoc($resultAirline)){
                if(password_verify($password, $row['password'])){
                    session_start();
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['user-type'] = "airline";
                    $_SESSION['email'] = $userEmail;
                    echo "Successfully Logged In";
                    header('Location: ../admin/adminDashboard.php');

                    // exit();
                }

                else{
                    echo "Password didn't match";
                }
            }
        }

        //login for admin
        elseif($resultAdmin && mysqli_num_rows($resultAdmin) == 1) {
            # code...
            while($row=mysqli_fetch_assoc($resultAdmin)){
                if(hash('sha256', $password) === $row['password']){
                    session_start();
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['user-type'] = "admin";
                    $_SESSION['email'] = $userEmail;
                    $_SESSION['a_name'] = $row['name'];
                    $firstLetter = strtoupper($row['name'][0]);
                    $_SESSION['nameInitial'] = $firstLetter;
                    $_SESSION['admin_id'] = $row['admin_id'];
                    echo "Successfully Logged In";
                    header('Location: ../admin/airlineReviewTable.php');
                    // exit();
                }

                else{
                    echo "Password didn't match";
                }
            }
        }  
        
        else{
            echo "No user found";
            header('Location: login.php');
        }
    }

    else{
        echo "Wrong method of fetching";
    }
?>

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include ('../partials/_db_connect.php');
        $userEmail = $_POST['email'];
        $password = $_POST['password'];

        $sqlPassengerCheck = "SELECT * FROM `users` WHERE `email` = '$userEmail'";
        $resultPassenger = mysqli_query($conn, $sqlPassengerCheck);

        //Passenger Login
        if($resultPassenger){
            $num = mysqli_num_rows($resultPassenger);

            if($num==1){
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

            else{
                echo "No user found";
            }
        }
    }
?>
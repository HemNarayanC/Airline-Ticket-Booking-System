<?php

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_GET['form']) && $_GET['form']=='passenger'){
        if( !empty($_POST['fname']) && !empty($_POST['lname']) &&
            !empty($_POST['phone']) && !empty($_POST['email']) &&
            !empty($_POST['pw']) && !empty($_POST['c_pw'])
            ){
                include ('../partials/_db_connect.php');
                $fname = $_POST['fname'];
                $mid_name = $_POST['mid_name'];
                $lname = $_POST['lname'];
                $phone = $_POST['phone'];
                $userEmail = $_POST['email'];
                $password = $_POST['pw'];
                $confirmpw = $_POST['c_pw'];

                $sqlCheck = "SELECT * FROM `users` WHERE `email` = '$userEmail'";
                $result = mysqli_query($conn, $sqlCheck);

                $numberOfExistingUsers = mysqli_num_rows($result);
                if($numberOfExistingUsers > 0){
                    header('Location: signup.php?alert=userExist');
                }

                else{
                    if($password == $confirmpw){
                        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                        $passengerInsert = "INSERT INTO `users` (`fname`,`mid_name`,`lname`,`phone`,`email`,`password`)VALUES('$fname','$mid_name','$lname','$phone','$userEmail','$hashPassword')"; 
                        $result = mysqli_query($conn, $passengerInsert);

                        if($result){
                            header('Location: login.php');
                            echo "Inserted Successfully";
                        }

                    }

                    else{
                        echo "Enter same password";
                    }
                }

            }

            else{
                echo "Fields are empty";
            }
    }


?>
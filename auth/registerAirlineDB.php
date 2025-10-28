<?php

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_GET['form']) && $_GET['form']=='airline'){
        if( !empty($_POST['registration_number']) && !empty($_POST['company-name']) &&
            !empty($_POST['phone']) && !empty($_POST['email']) &&
            !empty($_POST['password']) && !empty($_POST['c_pw']) && 
            !empty($_POST['address']) 
            ){
                include ('../partials/_db_connect.php');
                $redg_no = $_POST['registration_number'];
                $company_name = $_POST['company-name'];
                $phone = $_POST['phone'];
                $userEmail = $_POST['email'];
                $password = $_POST['password'];
                $confirmpw = $_POST['c_pw'];
                $address = $_POST['address'];

                $sqlCheck = "SELECT * FROM `airline` WHERE `registration_no` = '$redg_no'";
                $result = mysqli_query($conn, $sqlCheck);

                $numberOfExistingUsers = mysqli_num_rows($result);
                if($numberOfExistingUsers > 0){
                    header('Location: signup.php?alert=airlineExist');
                }

                else{
                    if($password == $confirmpw){
                        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                        $airlineInsert = "INSERT INTO `pending_airline` (`registration_no`,`c_name`,`email`,`phone`,`password`, `address`)
                        VALUES
                        ('$redg_no','$company_name','$userEmail','$phone','$hashPassword','$address')"; 
                        $result = mysqli_query($conn, $airlineInsert);

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
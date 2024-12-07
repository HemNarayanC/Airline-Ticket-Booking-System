

<?php

    session_start();
    include('../partials/_db_connect.php');


    if(!isset($_SESSION['loggedIn'])){
        header('Location: ../auth/login.php');
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        //for approval
        if(isset($_POST['approve_id'])) {
            $approve_id = $_POST['approve_id'];

            //updating the status in the pending airline table
            $updateQuery = "UPDATE `pending_airline` SET `status` = 'approved'";
            $resultUpdate = mysqli_query($conn, $updateQuery);

            if($resultUpdate){
                echo "Pending ID : $approve_id approved successfully";
            }

            else{
                echo "Error updating status".mysqli_error();
            }


            //fetching data and moving to airline table after appoval
            $fetchApprovedQuery = "SELECT * FROM `pending_airline` WHERE  `pending_id` = '$approve_id'";
            $fetchResult = mysqli_query($conn, $fetchApprovedQuery);
            $numOfFetchedRows = mysqli_num_rows($fetchResult);

            if($fetchResult && $numOfFetchedRows > 0) {
                $row = mysqli_fetch_assoc($fetchResult);

                //Inserting the approved data to airline table
                $insertQuery = "INSERT INTO airline (`registration_no`,`c_name`,`email`,`phone`,`password`,`address`)
                                VALUES('".$row['registration_no']."',
                                        ".$row['c_name'].",
                                        ".$row['email'].",
                                        ".$row['phone'].",
                                        ".$row['password'].",
                                        ".$row['address'].")";

                $resultInsertion = mysqli_query($conn, $resultInsertion);
                if($resultInsertion){
                    echo "Data inserted into airline table successfully";
                }

                else{
                    echo "Error inserting into airline table".mysqli_error();
                }
            }

            else{
                echo "No data found for the pending ID: $approve_id";
            }
        }

        else{
            echo "No record found for provided Id";
        }

        //for reject
    }



?>


<?php

    session_start();
    include('../partials/_db_connect.php');


    if(!isset($_SESSION['loggedIn'])){
        header('Location: ../auth/login.php');
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
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
        }
    }



?>
<?php

    session_start();

    //making session variables free
    session_unset();

    //destroying the variables
    session_destroy();

    echo "Logged Out Successfully";


    header('Location: login.php');

?>
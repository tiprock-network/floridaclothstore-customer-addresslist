<?php
    require('config.php');
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    //check connection status
    if(mysqli_connect_errno()){
        //echo out default error message
        echo 'A problem has occurred with the database connection.';
    }
?>
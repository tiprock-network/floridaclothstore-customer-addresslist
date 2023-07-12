<?php
    require('../config/db.php');
    if(isset($_POST['submit']))
    {
        $email=$_POST['uemail'];
        $pass=password_hash($_POST['npass'],PASSWORD_BCRYPT);
        $query="UPDATE employeeTbl SET empPass='$pass' where empEmail='$email'";
        mysqli_query($conn,$query);
        header("Location: ../pages/index.php");
        exit();
    }
    
?>
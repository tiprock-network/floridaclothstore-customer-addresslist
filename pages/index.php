<?php 
    session_start();
    //clear warnings
    error_reporting(0);
    include '../inc/header.php'; 
    

    //session variables
    $username=$_SESSION['username'];
    //control user content with access
    if($username){
        include '../pages/body.php';
    }else{
        include '../pages/locked_view.php';
    }

    if(isset($_POST['submit'])){
        session_destroy();
        header('Location: index.php');
        exit();
    }
?>

<?php include '../inc/footer.php'; ?>

<?php 
    error_reporting(0);
    include '../inc/header.php'; 

    if($_GET['key'] && $_GET['reset']){
        $email=$_GET['key'];
        $password=$_GET['reset'];

        //time
        $timestamp=time();
        $timestamp_value=intval(date('YmdHis',$timestamp));
        

        //query
        $query="SELECT empEmail,empPass FROM employeeTbl WHERE empPass='$password' AND CAST(resetExpiration AS UNSIGNED)>='$timestamp_value'";
        $res=mysqli_query($conn,$query);
        //collect rows
        if(mysqli_num_rows($res)==1){
?>
    

    <div class="main-container border-line">
        <div class="form-head access">
            
            <p>Password Reset</p>
        </div>

        <form method="post" action="../auth/update.php">
                <div class="field access-page">
                    <label for="uemail">Enter your email</label>
                    <br>
                    <input type="email" name="uemail" id="uemail" placeholder="e.g. janetjuma@example.com">
                </div>

                <div class="field access-page">
                    <label for="npass">Enter new Password</label>
                    <br>
                    <input type="password" name="npass" id="npass">
                </div>

                
                <div class="field">
                    <center><a href="login.php">Back to sign in</a></center>
                    <br>
                    <a href="index.php"><button type="submit" name="submit">Update password</button></a>
                </div>
                
            </form>
            
    </div>
<?php

}else{
    echo '
    <div class="main-container border-line" style="border: none; margin-top: 5%;">
    <div class="field info">
        <center><p style="color:rgb(211, 37, 37); font-size: 30px"><b>Oops...something has failed</b></p></center>
        <center><p style="color:rgb(211, 37, 37);"> Your reset link has expired. Kindly go back and send another email.</p></center>
            <div class="container-image">
                <img src="../static/pics/cry.gif">
            </div>
        
    </div>
    </div>
    ';
}
}
?>
<?php include '../inc/footer.php'; ?>

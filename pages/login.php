<?php 
    //session is started for the user
    session_start();
    //clear warnings
    error_reporting(0);
    //ini_set('session.gc_maxlifetime', 90);
    include '../inc/header.php'; 
    
    //sanitize the data input
    /*function sanitize($x){
        $clean=trim($x);
        $clean=stripslashes($clean);
        $clean=htmlspecialchars($clean);

        return $clean;
    }*/


    if(isset($_POST['submit'])){
        $email=$_POST['uemail'];//sanitize($_POST['uemail']);
        $pass=$_POST['upass'];//sanitize($_POST['upass']);//password_hash($_POST['upass'],PASSWORD_BCRYPT);
        //query
        $get_all_employees="SELECT empName,empEmail,empPass FROM employeeTbl WHERE empEmail='$email'";
        $result=mysqli_query($conn,$get_all_employees);

        if($result){
            if(mysqli_num_rows($result)==1){
                $row=mysqli_fetch_assoc($result);
                $hashed_pass=$row['empPass'];

                if(password_verify($pass,$hashed_pass)){
                    

                    //session variables
                    $_SESSION['username']=$row['empName'];
                    
                    if($_SESSION['username']){
                        
                        echo ' 
                        <div class="main-container border-line success">
                        <div class="field info" id="submitMsg">
                            <p style="color:rgb(24, 155, 78);"><b>Hi, '.$_SESSION['username'].'. You have successfully logged in.</b></p>
                            <p>You can now go back home - <a href="index.php"><u>Back to home</u></a></p>
                        </div>
                        </div>';

                        header('Location: '.ROOT_URL.'');
                    }
                    
                }else{
                    echo ' 
                        <div class="main-container border-line">
                        <div class="field info" id="submitMsg">
                            <p style="color:rgb(211, 37, 37);"><b>Error occurred</b></p>
                            <p style="color:rgb(211, 37, 37);">We think either you email or password is incorrect.</p>
                        </div>
                        </div>';
                }

            }else{
                echo ' 
                        <div class="main-container border-line">
                        <div class="field info err" id="submitMsg">
                            <p style="color:rgb(211, 37, 37);"><b>Error occurred</b></p>
                            <p style="color:rgb(211, 37, 37);">We think either you email or password is incorrect.</p>
                        </div>
                        </div>';
            }
        }else{
            echo ' 
                        <div class="main-container border-line">
                        <div class="field info" id="submitMsg">
                            <p style="color:rgb(211, 37, 37);"><b>Error occurred</b></p>
                            <p style="color:rgb(211, 37, 37);">Oops...something went wrong.</p>
                        </div>
                        </div>';
        }
    }
?>
    <div class="main-container border-line">
        <div class="form-head access">
            <h2>Florida Cloth Store Login</h2>
            <p>Welcome to the clothing line store, please enter your details to login in.</p>
        </div>

        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">

                <div class="field access-page">
                    <label for="uemail">Email</label>
                    <br>
                    <input type="email" name="uemail" id="uemail" placeholder="e.g. janetjuma@example.com">
                </div>

                <div class="field access-page">
                    <label for="upass">Password</label>
                    <br>
                    <input type="password" name="upass" id="upass">
                </div>

                <div class="field">
                    <center><a href="reset.php">Forgot your password ? </a></center>
                    <br>
                    <a href="index.php"><button type="submit" name="submit">Login</button></a>
                </div>
                
            </form>
            <div class="field">
                    <center><a href="signup.php">Don't have an account ?</a></center>
            </div> 
    </div>
<?php include '../inc/footer.php'; ?>

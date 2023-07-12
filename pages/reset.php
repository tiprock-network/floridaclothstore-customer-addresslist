<?php 
    error_reporting(0);
    include '../inc/header.php'; 
    
?>
    <div class="main-container border-line">
        <div class="form-head access">
            
            <p>Password Reset</p>
        </div>

        <form method="post" action="../auth/reset.php">

                <div class="field access-page">
                    <label for="uemail">Email</label>
                    <br>
                    <input type="email" name="uemail" id="uemail" placeholder="e.g. janetjuma@example.com">
                </div>

                
                <div class="field">
                    <center><a href="login.php">Back to sign in</a></center>
                    <br>
                    <a href="index.php"><button type="submit" name="submit">Send link</button></a>
                </div>
                
            </form>
            
    </div>
<?php include '../inc/footer.php'; ?>

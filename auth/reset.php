<?php
    //import phpmailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    
    include '../inc/header.php';
    if(isset($_POST['submit'])){
        //acquire the password and email from the database
        $email=$_POST['uemail'];
        $sql_query="SELECT empName,empEmail,empPass FROM employeeTbl WHERE empEmail='$email'";
        $result=mysqli_query($conn,$sql_query);

        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            $hashed_pass=$row['empPass'];
            $hashed_email=password_hash($row['empEmail'],PASSWORD_BCRYPT);
            $emp_email=$row['empEmail'];
            $emp_name=$row['empName'];
            //create reset link
            //reset token
            $timestamp=time()+600;
            $timestamp_value=date('YmdHis',$timestamp);
            //query to store timestamp
            $timestamp_query="UPDATE employeeTbl SET resetExpiration='$timestamp_value' WHERE empEmail='$emp_email'";
            mysqli_query($conn,$timestamp_query);
            //link

            $crude_link="".RESET_CALLBACK."?key=".$hashed_email."&reset=".$hashed_pass."";
            $reset_link = "<a href='" . RESET_CALLBACK . "?key=" . $hashed_email . "&reset=" . $hashed_pass . "' style='margin-left: 50px; color: rgb(211, 37, 37); font-size: 14px;'>" . $crude_link . "</a>";
            //create email
            require('../vendor/autoload.php');
            $mail=new PHPMailer(true);

            //try sending email
            try{
                $mail->isSMTP();
                $mail->Host = "";//smtp.gmail.com
                $mail->SMTPAuth = true;
                $mail->Username = ''; // SMTP username
                $mail->Password = ''; // gmail App password
                $mail->SMTPSecure = "ssl"; 
                $mail->Port = ; // Set the SMTP port
                // Sender and recipient
                $mail->setFrom('', 'Florida Cloth Store'); // Set the sender's email address and name
                $mail->addAddress($emp_email, $emp_name); // Set the recipient's email address and name

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password Link';
                $mail->Body = '
                    <div style="
                    font-family: Arial, Helvetica, sans-serif; 
                    font-size: 16px; 
                    color: #333;
                    width: 80%;
                    transform:translateX(10%);">
                        
                        <div style="width: 50%; margin-left:30%; border: none; border-radius: 25px;">
                        <center>
                            <h1 style="font-weight: 800; color: #fff; color: rgb(211, 37, 37);">
                            Florida Cloth Store Westlands, Nairobi Branch
                            </h1>
                        </center>
                        </div>

                        <center><p style="margin-left: 15px; color: #333;"><strong>Password reset link</strong></p></center>
                        <center>
                            <p style="margin-left: 15px; font-size: 14px; color: #333;">
                                Hey, '.explode(' ',$emp_name)[0].'. You can click this link to reset your password. <b>The link will be valid for 10 minutes.</b>
                            </p>
                        </center>
                        <div style="margin-left: 10%;">
                            '.$reset_link.'
                        </div>
                    </div>
                ';

                if($mail->Send()){
                    echo '
                    <div class="main-container border-line success" style="border: none; margin-top: 5%;>
                    <div class="field info">
                    <center><p style="color:rgb(24, 155, 78); font-size: 30px"><b>Email sent successfully</b></p></center>
                    <center><p style="color:rgb(24, 155, 78);">There is a reset link that has been sent.</p></center>
                        <div class="container-image">
                            <img src="../static/pics/happy.gif">
                    </div>
                    </div>
                    ';
                }
                

            }catch(Exception $e){
                echo '
                <div class="main-container border-line" style="border: none; margin-top: 5%;">
                <div class="field info">
                <center><p style="color:rgb(211, 37, 37); font-size: 30px"><b>Oops...something has failed</b></p></center>
                <center><p style="color:rgb(211, 37, 37);">Failed to send message with error- '.$mail->ErrorInfo.'</p></center>
                        <div class="container-image">
                            <img src="../static/pics/cry.gif">
                        </div>
                    
                </div>
                </div>
                ';
            }
        }
    }

    include '../inc/footer.php';
?>

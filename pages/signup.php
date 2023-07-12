<?php 
    include '../inc/header.php'; 

    //check for a submission that has been done
    if(isset($_POST['submit'])){
        //get data from the form
        $empId='EMP-'.date("yndHis");
        $uname=mysqli_real_escape_string($conn,$_POST['name']);
        $email=mysqli_real_escape_string($conn,$_POST['uemail']);
        $phone=mysqli_real_escape_string($conn,$_POST['uphone']);
        $pass=mysqli_real_escape_string($conn,(password_hash($_POST['upass'],PASSWORD_BCRYPT)));

        // Query to check if a similar email already exists
        $check_email_query = "SELECT COUNT(*) AS email_count FROM employeeTbl WHERE empEmail = '$email'";
        $check_email_result = mysqli_query($conn, $check_email_query);


        if($check_email_result){
            $email_count_row = mysqli_fetch_assoc($check_email_result);
            $email_count = $email_count_row['email_count'];
            
            if($email_count){
                echo ' 
                    <div class="main-container">
                    <div class="field info" id="submitMsg">
                        <p style="color:rgb(211, 37, 37);"><b>Error occurred</b></p>
                        <p style="color:rgb(211, 37, 37);">This email is being used by another person.</p>
                    </div>
                    </div>';
                
            }else{
                //query to insert values into table
                $insert_emp="INSERT INTO employeetbl(empId,empName,empEmail,empPhone,empPass) VALUES('$empId','$uname','$email','$phone','$pass')";

                if(mysqli_query($conn,$insert_emp)){
                    echo ' 
                    <div class="main-container">
                    <div class="field info" id="submitMsg">
                        <p style="color:rgb(24, 155, 78);"><b>Success</b></p>
                        <p style="color:rgb(24, 155, 78);">A new employee ID: '.$empId.' has been added.</p>
                        <br>
                        <a href="login.php"><b>Back to login</b></a>
                    </div>
                    </div>';
                }else{
                    echo ' 
                    <div class="main-container">
                    <div class="field info" id="submitMsg">
                        <p style="color:rgb(211, 37, 37);"><b>Error occurred</b></p>
                        <p style="color:rgb(211, 37, 37);">'.mysqli_error($conn).'</p>
                    </div>
                    </div>';
                }

            }
    }
        }

?>
 
    

    <div class="main-container animate">
        <div class="form-head">
            <h2>Florida Cloth Store Employee's Register</h2>
            <p>Hi, you need to fill in this form to register.</p>
        </div>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
                <div class="field">
                    <label for="reg"><i class="fa fa-address-card"></i> Employee Registration Number</label>
                    <br>
                    <br>
                    <p>Employee registration number is generated automatically by the system.</p>
                    <br>
                    <p>Registration number: <strong id="regTime"><?php echo ('EMP-'.date("yndHis"));?></strong></p>
                </div>
                <div class="main-container-errors" id="validateSubCont">
                    <!--Container for error check before submission-->
                </div>

                <div class="field">
                    <label for="name">Name</label>
                    <br>
                    <input type="text" name="name" id="name" placeholder="e.g. Janet Juma" required>
                </div> 

                <div class="field">
                    <label for="uemail">Email</label>
                    <br>
                    <input type="email" name="uemail" id="uemail" placeholder="e.g. janetjuma@example.com">
                    <br>
                    <div id="emailMsg" class="inputMsg"></div>
                </div>

                <div class="field">
                    <label for="uphone">Phone Number</label>
                    <br>
                    <input type="phone" name="uphone" id="uphone" placeholder="e.g. 254709001230" required>
                    <br>
                    <div id="pnumberMsg" class="inputMsg"></div>
                </div>

                <div class="field">
                    <label for="upass">Password</label>
                    <br>
                    <input type="password" name="upass" id="upass" required>
                    <div id="passMsg" class="inputMsg"></div>
                </div>

                <div class="field">
                <center><a href="index.php">Back home</a></center>
                <br>
                <button type="submit" name="submit" onclick="scrolltoMsg()"><i class="fa fa-user-plus"></i> Add Employee</button>
                </div>
            </form>
            
    </div>
    <script>
        setTimeout(function () {
        var date = new Date();
        var timeFormat = date.getFullYear().toString().slice(-2) + (date.getMonth() + 1) + date.getDate() + (date.getHours()-1) + date.getMinutes() + date.getSeconds();
        document.getElementById("regTime").textContent = `EMP-${timeFormat}`;
        setTimeout(arguments.callee, 1000); // Repeat the function every second
    }, 1000);

        

        //msg for phone
        const pnumberMsg=document.getElementById('pnumberMsg');

        //check for number input
        const numberInput=document.getElementById('uphone');
        numberInput.addEventListener('input',()=>{
            if(!(validPhoneNumber(numberInput.value)))
            pnumberMsg.innerHTML='<p style="color: rgb(211, 37, 37);"><i class="fa fa-circle-xmark"></i> This phone number is invalid, it should look like - <b>254709001230</b> and be a 12-digit number.</p>';
            else
            pnumberMsg.innerHTML='<p style="color: rgb(24, 155, 78);"> <i class="fa fa-circle-check"></i> Phone number accepted.</b></p>';

            

        })

        //valid number function
        function validPhoneNumber(phone){
            let phoneNumber=/^254\d{9}$/;
            return phoneNumber.test(phone);
        }

        //validate email
        //msg for email
        const emailMsg=document.getElementById('emailMsg');

        //check for number input
        const emailInput=document.getElementById('uemail');
        emailInput.addEventListener('input',()=>{
            if(!(validateEmail(emailInput.value)))
            emailMsg.innerHTML='<p style="color: rgb(211, 37, 37);"><i class="fa fa-circle-xmark"></i> This email looks invalid.</p>';
            else
            emailMsg.innerHTML='<p style="color: rgb(24, 155, 78);"> <i class="fa fa-circle-check"></i> Email is valid.</b></p>';

            

        })

        //valid email function
        function validateEmail(email){
            let inputemail=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return inputemail.test(email);
        }

        //validate password
        //msg for password input
        const passMsg=document.getElementById('passMsg');

        //check for number input
        const passInput=document.getElementById('upass');
        passInput.addEventListener('input',()=>{
            if(!(validatePassword(passInput.value)))
            passMsg.innerHTML='<p style="color: rgb(211, 37, 37);"><i class="fa fa-circle-xmark"></i> Your password is too short or does not have special characters like -, # , *, /, ( , )</p>';
            else
            passMsg.innerHTML='<p style="color: rgb(24, 155, 78);"> <i class="fa fa-circle-check"></i> Your password is strong.</b></p>';

            

        })

        //valid password function
        function validatePassword(pass){
            let passformat=/[-#,*/()]/;
            if(pass.length>=8){
                return passformat.test(pass);// returns either false or true
            }else{
                return false;
            }
        }

        //check for empty spaces then scroll up and submit
        //id="submitMsg"
        const validateBoxMsg=document.getElementById('validateSubCont');
        const nameInput=document.getElementById('name');
        function scrolltoMsg(){
            
            //check for empty inputs
            if(!(nameInput.value && emailInput.value && numberInput.value && passInput.value)){
                validateBoxMsg.style.display='block';
                validateBoxMsg.innerHTML=`
                <div class="field info" id="submitMsg">
                    <p style="color:rgb(211, 37, 37);"><b>No input found</b></p>
                    <p style="color:rgb(211, 37, 37);">Kindly correctly fill in all fields.</p>
                 </div>
                 `;
                 window.scrollTo(0,0);
            }else{
                if(validPhoneNumber(numberInput.value) && validateEmail(emailInput.value) && validatePassword(passInput.value)){
                    validateBoxMsg.style.display='none';
                    window.scrollTo(0,0);
                }else{
                    validateBoxMsg.style.display='block';
                    validateBoxMsg.innerHTML=`
                    <div class="field info" id="submitMsg">
                        <p style="color:rgb(211, 37, 37);"><b>Invalid inputs</b></p>
                        <p style="color:rgb(211, 37, 37);">Kindly correctly fill in all fields.</p>
                    </div>
                    `;
                    window.scrollTo(0,0);
                    
                }
            }
        }

    </script>
<?php include '../inc/footer.php'; ?>

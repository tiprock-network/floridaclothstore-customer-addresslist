<?php
    require('db.php');

    //fetch the data from the database
    function fetchCustomers(){
        global $conn;
        //sql query
        $query='SELECT * FROM custTbl';
        $result=mysqli_query($conn,$query);
        //place it in an array
        $customers=array();
        while($customer=mysqli_fetch_assoc($result)){
            $customers[]=$customer;
        }
        return $customers;
    }

    //add data to the server database
    function addCustomer($uname,$uemail,$uphone,$uaddr){
        global $conn;
        //data about attendee
        $cust_id='CUST-'.date("yndHis");
        $uname=mysqli_real_escape_string($conn,$uname);
        $uemail=mysqli_real_escape_string($conn,$uemail);
        $uphone=mysqli_real_escape_string($conn,$uphone);
        $uaddr=mysqli_real_escape_string($conn,$uaddr);
        

        //DML query for insertion
        $sql_query="INSERT INTO custTbl VALUES('$cust_id','$uname','$uemail','$uphone','$uaddr')";
        mysqli_query($conn,$sql_query);

    }

    //delete an attendee from the database
    function removeCustomer($custId){
        global $conn;
        $cust_id=mysqli_real_escape_string($conn,$custId);
        $del_query="DELETE FROM custTbl WHERE custRegNo='$cust_id'";
        mysqli_query($conn,$del_query);

    }


    // Handle client requests
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch data and return as JSON
        $data = fetchCustomers();//get all customers
        header('Content-Type: application/json');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Insert data from client request
        $name = $_POST['uname'] ?? '';
        $email = $_POST['uemail'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $addr = $_POST['addr'] ?? '';
        addCustomer($name,$email,$phone,$addr);
    } elseif($_SERVER['REQUEST_METHOD']=== 'DELETE'){
        //remove an attendee
        $customer_id=$_GET['custId'] ?? '';
        removeCustomer($customer_id);
    }
    ?>



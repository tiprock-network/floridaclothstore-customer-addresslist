<?php
require('db.php');
//get a customer from the database
function findCustomer($custId){
    global $conn;
    $cust_id=mysqli_real_escape_string($conn,$custId);
    $get_query="SELECT * FROM custTbl WHERE custRegNo='$cust_id'";
    $result=mysqli_query($conn,$get_query);

     
     return mysqli_fetch_assoc($result);

}


// Handle client requests
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch data and return as JSON
        $custRegNo = $_GET['custId'] ?? '';
        $data = findCustomer($custRegNo);//get customer
        header('Content-Type: application/json');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
   } 
?>
<?php
    require('db.php');

    //fetch the data from the database
    function fetchAllCustomersInfo(){
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

    
    $filename='customersInfo.csv';
    $file=fopen($filename,'w');
    $data=fetchAllCustomersInfo();

    //add csv column titles
    $col_titles=array('Registration Number','Name','Email','Phone','Physical address');
    fputcsv($file,$col_titles);
    foreach($data as $row){
        $phone_number_str= sprintf("'%s'",$row['custPhone']);
        $row['custPhone']=$phone_number_str;
        fputcsv($file,$row);
    }

    //add csv column titles
    $col_titles=array('Registration Number','Name','Phone','Email','Physical address');

    fclose($file);

    //describe content header
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Content-Length: '.filesize($filename));

    //read content
    readfile($filename);
    //delete from the server
    unlink($filename);
?>
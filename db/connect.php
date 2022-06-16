<?php
    $host="localhost"; 
    $username="root";
    $password="";
    $dbname="shop";
    $conn=new mysqli($host,$username,$password,$dbname);
    mysqli_set_charset($conn, 'UTF8');
    if($conn->connect_error){
        die("kết nối không thành công". $conn->connect_error);

    }
    // echo "kết nối thành công";
?>

<?php
   
    require'./db/connect.php';//kết nối database
    
    $sql="SELECT * FROM products";
    $result=$conn->query($sql);
    $products=array();
    while($rows=$result->fetch_assoc()){
        array_push($products,$rows);
    }
    
?>
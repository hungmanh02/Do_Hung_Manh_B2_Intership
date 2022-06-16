<?php
    //  session_start();
     require'./db/connect.php';//kết nối database
        $sql="SELECT * FROM products as p  INNER JOIN USERS on p.user_id = USERS.id_user ";
        $result=$conn->query($sql);
        $products=array();
        while($rows=$result->fetch_assoc()){
            array_push($products,$rows);
     }
     
     


?>
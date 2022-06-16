<?php
    //  session_start();
     require'./db/connect.php';//kết nối database
        $sql="SELECT * FROM CATEGORIES as c  INNER JOIN USERS on c.user_id = USERS.id_user ";
        $result=$conn->query($sql);
        $categories=array();
        while($rows=$result->fetch_assoc()){
            array_push($categories,$rows);
     }
     
     


?>
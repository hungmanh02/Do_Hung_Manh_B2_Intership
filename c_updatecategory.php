<?php
    include"./db/connect.php";
    session_start();
    if(isset($_POST['update_submit'])){
        if(isset($_SESSION['id_user']) && isset($_SESSION['user_email'])){
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $id_category=$_POST['id_category'];
            $parent_id=test_input($_POST['parent_id']);
            $name=test_input($_POST['name']);
            $user_id=test_input($_SESSION['id_user']);
            
            try
            {
                $sql = "UPDATE categories SET name='$name', user_id='$user_id',parent_id=$parent_id  WHERE id_category='$id_category'";
                $result=$conn->query($sql);
                header('location:./editcategory.php?id='.$id_category);
            }catch(Exception $e)
            {
                die($e->getMessage());
            }
         }
    }
    


?>
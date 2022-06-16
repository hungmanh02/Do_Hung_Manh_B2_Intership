<?php
    session_start();
    include"./db/connect.php";
    if(isset($_POST['add_submit'])){
        if(isset($_SESSION['id_user']) && isset($_SESSION['user_email'])){
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $name=test_input($_POST['name']);
            $parent_id=test_input($_POST['parent_id']);
            $user_id=test_input($_SESSION['id_user']);
            if(empty($name)){
                header("location:../category.php?error=Name category required");
            }else {
                $sql="SELECT * FROM categories c JOIN users u ON u.id_user=c.user_id  WHERE c.user_id='$user_id' AND c.name='$name'";
                $result=$conn->query($sql);
                $row=mysqli_fetch_assoc($result);
                if(isset($row)){
                    header("location:../addcategory.php?error=Name category unique");
                }else{
                    try
                    {
                        
                        $sql = "INSERT INTO categories (name, user_id,parent_id) VALUES ('$name', '$user_id',$parent_id)";
                        $result=$conn->query($sql);
                        header("location:../category.php?success=Add category success");
                    }catch(Exception $e)
                    {
                        die($e->getMessage());
                    }
                    
                    
                }
                
                
            }
        }
    }


?>
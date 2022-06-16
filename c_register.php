<?php
        include"./db/connect.php";
        if(isset($_POST["submit"]) && $_POST["user_name"] !='' && $_POST["user_password"] != '' && $_POST["user_config_password"] != '' ){
            // thực hiện xử lý user khi ấn submit và điền đầy đủ thông tin
            $username=$_POST["user_name"];
            $email=$_POST["user_email"];
            $password=$_POST["user_password"];
            $configpassword=$_POST["user_config_password"];
            if($password != $configpassword){
                header("location:../register.php");
            }
            $password=md5($password);
            $sql="SELECT * FROM users WHERE user_email='$email'";
            $old=$conn->query($sql);
            if(mysqli_num_rows($old)>0){
                header("location:../register.php");
            }else{
                $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$username', '$email', '$password')";
                $conn->query($sql);
                header("location:./dashboard.php");
            }
            
            
        }else{
            header("location:../register.php");
        }

?>
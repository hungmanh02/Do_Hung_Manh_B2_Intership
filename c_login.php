<?php
    session_start();
    include"./db/connect.php";
    if(isset($_POST["user_email"]) && isset($_POST["user_password"])){

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        $email=test_input($_POST["user_email"]);
        $password=test_input($_POST["user_password"]);
        if(empty($email)){
            header("location:../index.php?error=User Name is Required");
        }else if(empty($password)){
            header("location:../index.php?error=Password is Required");
        }else {
            // echo "Cool!";
            $password=md5($password);
            $sql="SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
            $result=$conn->query($sql);
            // echo mysqli_num_rows($result);
            if(mysqli_num_rows($result) === 1){
                 $row=mysqli_fetch_assoc($result);
                 if($row['user_password'] ===$password){
                     $_SESSION['id_user']=$row['id_user'];
                     $_SESSION['user_name']=$row['user_name'];
                     $_SESSION['user_role']=$row['user_role'];
                     $_SESSION['user_email']=$row['user_email'];
            
                     header("location:../dashboard.php");
                 }else{
                    header("location:../index.php?error=Nhập email và mật khẩu");
                }
            }else{
                header("location:../index.php?error=Nhập email và mật khẩu");
            }
        }

    }else{
        header("location:../index.php");
    }
?>
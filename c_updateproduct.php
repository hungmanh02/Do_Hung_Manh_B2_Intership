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
            $id_product=test_input($_POST['id_product']);
            $name=test_input($_POST['product_name']);
            $quantity=test_input($_POST['product_quantity']);
            $price=test_input($_POST['product_price']);
            $description=test_input($_POST['product_description']);
            $category_id=test_input($_POST['category_id']);
            $user_id=test_input($_SESSION['id_user']);
            $created_at=test_input($_POST['created_at']);
            try
            {
                $ex=array('jpg','png','jpeg'); 
                $folder_path='uploads/products/';    
                $file_path=$folder_path.$_FILES['product_image']['name'];
                $file_type=strtolower(pathinfo($file_path,PATHINFO_EXTENSION));
                $flag_ok=true;
                if(!in_array($file_type,$ex)){
                    //check type image
                    $flag_ok=false;
                    //header("location:../editproduct.php?error=file không hợp lệ hãy dùng các file có dạng jpg, png, jpeg");
                }else{
                    if($_FILES['product_image']['size']>500000){
                        //check dung lượng uploads files
                        $flag_ok=false;
                        //header("location:../editproduct.php?error=dung lượng file lớn 500000  bytes");
                    }else{ 
                    $product_image=$file_path;
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $updated_at=date('Y/m/d H:i:s');
                    move_uploaded_file($_FILES['product_image']['tmp_name'],$file_path);
                    $sql = "UPDATE products SET product_name='$name', user_id='$user_id',category_id='$category_id',product_image='$product_image',
                    product_quantity='$quantity',product_description='$description',product_price='$price',created_at='$created_at',updated_at='$updated_at' 
                    WHERE id_product='$id_product'";
                    $result=$conn->query($sql);
                    header('location:./editproduct.php?id='.$id_product);
                    }
                }
            }catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
            
    }
    


?>
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
            $name=test_input($_POST['product_name']);
            $quantity=test_input($_POST['product_quantity']);
            $price=test_input($_POST['product_price']);
            $description=test_input($_POST['product_description']);
            $category_id=test_input($_POST['category_id']);

            // $image=test_input($_POST['product_image']);
            $user_id=test_input($_SESSION['id_user']);
            if(empty($name)){
                header("location:../addproduct.php?error=Name product required");
            }else {
                $sql="SELECT * FROM products p JOIN users u ON u.id_user=p.user_id  WHERE p.user_id='$user_id' AND p.product_name='$name'";
                $result=$conn->query($sql);
                $row=mysqli_fetch_assoc($result);
                if(isset($row)){
                    header("location:../addproduct.php?error=Name product unique");
                }else{
                    try
                    {
                        // var_dump($_FILES);
                        // move_uploaded_file($_FILES['product_image']['tmp_name'],'uploads/'.$_FILES['product_image']['name']) ;
                        $ex=array('jpg','png','jpeg'); 
                        $folder_path='uploads/products/';    
                        $file_path=$folder_path.$_FILES['product_image']['name'];
                        $file_type=strtolower(pathinfo($file_path,PATHINFO_EXTENSION));
                        $flag_ok=true;
                        //check phải file image không
                        $check=getimagesize($_FILES['product_image']['tmp_name']);
                        if($check !==false){
                            $flag_ok=true;
                            if(file_exists($file_path)){
                                //check file bị trùng
                                $flag_ok=false;
                                header("location:../addproduct.php?error=file hình tồn tại");
                            }else{
                                if(!in_array($file_type,$ex)){
                                    //check type image
                                    $flag_ok=false;
                                    header("location:../addproduct.php?error=file không hợp lệ hãy dùng các file có dạng jpg, png, jpeg");
                                }else{
                                    if($_FILES['product_image']['size']>500000){
                                        //check dung lượng uploads files
                                        $flag_ok=false;
                                        header("location:../addproduct.php?error=dung lượng file lớn 500000  bytes");
                                    }else{ 
                                    $product_image=$file_path;
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                    $created_at=date('Y/m/d H:i:s');
                                    move_uploaded_file($_FILES['product_image']['tmp_name'],$file_path);
                                    $sql = "INSERT INTO products (product_name, user_id,category_id,product_image,product_quantity,product_description,product_price,created_at)
                                     VALUES ('$name', '$user_id','$category_id','$product_image','$quantity','$description','$price','$created_at')";
                                    $result=$conn->query($sql);
                                    header("location:./addproduct.php?success=Add product success");
                                    }

                                }
                            }

                        }else{
                            header("location:./addproduct.php?error=không phải file images");
                        }
                        
                    }catch(Exception $e)
                    {
                        die($e->getMessage());
                    }
                    
                    
                }
                
                
            }
        }
    }


?>
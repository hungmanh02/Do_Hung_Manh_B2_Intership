<?php
  require'./db/sanpham.php';
  session_start();
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      .row-fix{
        margin: 0 auto;
      }
    </style>
  </head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="giohang.php">Giỏ Hàng</a>
        </li>
        
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
</div>
    <div class="container">
     
        <div class="row row-fix">
          <?php
                          foreach($sanpham as $row){
                    
                    ?>
          <div class="col">
                    
                    <div class="card" style="width: 18rem;">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body">
                          
                          <h4 class="card-title" name="ten"><?php echo $row['ten'];?></h4>
                          <p class="card-text" name="ngay_san_xuat">Ngày sản xuất: <?php echo $row['ngay_san_xuat'];?></p>

                          <form action="giohang.php" method="POST">
                          
                          <h6 class="card-title">Số lượng: 
                            <input type="number" name="so_luong" value="1">
                          </h6>
                          <input type="hidden" name="id" value="<?php echo $row['id']?>">
                          <input type="hidden" name="ten" value="<?php echo $row['ten']?>">
                          <input type="hidden" name="ngay_san_xuat" value="<?php echo $row['ngay_san_xuat']?>">
                          <input class="btn btn-primary" type="submit" name="submit" value="Mua"></input>
                          </form>
                        </div>
                    
                      </div>

          </div>
                      <?php
                          }
                    ?>
        </div>
      </div>
      
</body>
</html>
<?php ob_end_flush();?>

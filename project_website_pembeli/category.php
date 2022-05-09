<?php
require 'Connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Martabucks</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 0 auto;
            margin: 20px;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .card-deck{
            margin: 20px;
        }
        .card-img-top{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<?php error_reporting(0); session_start(); ?>
<body>
    <header class = "header"> 
        <nav class = "navbar navbar-style">
            <div class="container">
                <div class = "navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href=""><img class ="logo" src="image/logo.png"></a>
                </div>
                <div class="collapse navbar-collapse" id = "micon">
                <ul class="nav navbar-nav navbar-right"> 
                    <li><a href="Home_cust.php">Home</a></li>
                    <li><a href="Menu_cust.php">Menu</a></li>
                    <li><a href="category.php">Categories</a></li>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="Contact_Us.html">Contact Us</a></li>
                    <li><a href="Logout.php">Sign Out</a></li>
                </ul>
                </div>
    </header>

    <div class="container" style="text- align: center;">
        <input type="text" placeholder="Search.." name="search" style="width: 50%;">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>

        <h3 class="text-center text-light bg-info">Filter Menu</h3>
        <div class= "container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <h5>Filter product</h5>
                    <hr>
                    <h6 class ="text-info">Select Category</h6>
                    <ul class="list-group">
                        <?php 
                            $sql = "SELECT DISTINCT c.categories_name FROM categories c join `menu` m ON c.categories_id=m.categories_id ORDER BY c.categories_name";
                            $result= $conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                        ?>
                        <li class="list-group-item">
                                <div class="form-check">
                                <label class="form-check">
                                <input type="checkbox" class="form-check-input product_check" value="<?= $row['categories_name']; ?>" id="categories"><?= $row['categories_name']; ?>
                                </label>
                                </div>
                        </li>
                        <?php }?>
                    </ul>
                </div>
                <div class="col-lg-9">
                <H5  class ="text-center" id="textChange">All Products</H5>
                <hr>
                    <div class="text-center">
                        <img src="image/loader.gif" id ="loader" width ="200" style ="display:none;">
                    </div>
                    <div class="row" id="result">
                        <?php 
                            $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                            $cart = json_decode($cart);

                            $sql = "SELECT * From `menu` m join categories c ON c.categories_id=m.categories_id";
                            $result= $conn->query($sql);
                            while($row=$result->fetch_assoc()){

                                $flag = false;
                                 foreach($cart as $c){
                                     if($c->menu_id == $row['menu_id']){
                                         $flag = true;
                                         break;
                                     }
                                 }
                            
                        ?>
                        <div class="col-md-4 mb-2">
                            <div class ="card-deck">
                                <div class="card border-secondary">
                                    <img src="../<?php echo $row['menu_gambar']; ?>" class="card-img-top" width="200px" height="200px">
                                    <div class="card-img-overlay">
                                        <h6 style="margin-top:10px" class="text-light bg-info text-center rounded p-1">
                                            <?= $row['makanan_name'] ?>
                                        </h6>
                                    </div>
                                        <div class="card-body">
                                            <h4 class="card-title text-danger">Price: RP <?= number_format($row['menu_harga']); ?>/-</h4>
                                            <p>
                                                Deskripsi : <?= $row['menu_deskripsi']; ?>
                                            </p>

                                            <?php if ($flag) { ?>
                                                <form method="POST" action="cart-delete.php">
                                                <input type="hidden" name="action" value="menu">
                                                <input type="hidden" name="productCode" value="<?php echo $row['menu_id']; ?>">
                                                <input type="submit" value="Delete from cart" class="btn btn-danger btn-block">
                                                </form>
                                            <?php } else {?>
                                            <form method="POST" action="cart-add.php">
                                                <input type="hidden" name="action" value="menu">
                                                <input type="hidden" name="productCode" value="<?php echo $row['menu_id'];?>">
                                                <input type="submit" value="Add to cart" class="btn btn-success btn-block">
                                            </form>
                                            <?php }?>
                                        </div>
                                </div>
                            </div>
                    </div>
                    <?php } ?>
            </div>
                </div>
            </div>
        </div>


        
        
  
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $(".product_check").click(function(){
            $("#loader").show();

            var action= 'data';
            var categories =get_filter_text('categories');
            
            $.ajax({
                    url:'action.php',
                    method:'POST',
                    data:{action:action,categories:categories},
                    success:function(response){
                        $("#result").html(response);
                        $("#loader").hide();
                        $("#textChange").text("Filtered Products");
                    }
            });

    function get_filter_text(text_id){

        var filterData = [];
        $('#'+text_id+':checked').each(function(){
            filterData.push($(this).val());
        });
        return filterData;
    }
    });
});


</script>
</body>
</html>

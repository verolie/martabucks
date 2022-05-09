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
                <ul class="nav navbar-nav navbar-right" style="font-size: 20px;"> 
                    <li><a href="">Home</a></li>
                    <li><a href="Menu_cust.php">Menu</a></li>
                    <li><a href="category.php">Categories</a></li>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="Contact_Us.html">Contact Us</a></li>
                    <li><a href="Logout.php">Sign Out</a></li>
                </ul>
                </div>
    </header>

            <div class="container">
                <div class="row"> 
                    <div class="col-sm-6" id="tulisan">
                    <h1 >Martabucks</h1>
                        <p class="big-text">Martabak Rumahan</p>
                        <p>Pesan dan Pick Up menggunakan website</p>
                    </div>
                    <div class="col-sm-6">
                        <img src="image/background.jpg"  class="img-responsive" >
                    </div>
                </div>
            </div> 
    
            <div class="container" style="text-align: center;">
                <h1 class="Deskripsi">Deskripsi Website</h1>
                <div class="rowjustify-content-center text-center" style=" margin-left: 28%;">
                    <div class="card float-left col-md-4 mr-3" style="width: 20%;">
                        <div class="card-body">
                         <img class="img-fluid mb-4" src="image/order.png" alt="Card image cap" style="height: 100px; width: 100px;">
                         <p class="card-text">request your order</p> 
                        </div>
                       </div>
                       <div class="card float-left col-md-4 mr-3" style="width: 20%;">
                        <div class="card-body">
                         <img class="img-fluid mb-4" src="image/order.png" alt="Card image cap" style="height: 100px; width: 100px;">
                         <p class="card-text">Self PickUp</p> 
                        </div>
                       </div>
                       <div class="card float-left col-md-4 mr-3" style="width: 20%;">
                        <div class="card-body">
                         <img class="img-fluid mb-4" src="image/order.png" alt="Card image cap" style="height: 100px; width: 100px;">
                         <p class="card-text">Set up your time to pick up</p> 
                        </div>
                       </div>
                </div>
            </div>

            <div class="row" id="result">
                        <?php 
                            $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                            $cart = json_decode($cart);

                            $sql = "SELECT * From menu m join promosi p on m.menu_id=p.menu_id";
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
                        <!-- ?php 
                            $sql1 = "SELECT * from order_fix";
                            $query = mysqli_query($conn,$sql1);
                            $cust_id = $_SESSION['id'];
                            $num = mysqli_num_rows($query);
                            $no =  $num + 1;

                            $sql = "SELECT * From menu m join promosi p on m.menu_id=p.menu_id";
                            $result= $conn->query($sql);
                            while($row=$result->fetch_assoc()){
                                $id = $row['menu_id'];
                                $name = $row['makanan_name'];
                                $harga = $row['menu_harga'];
                                $order_id = $no;
                        ?> -->
                        <div class="col-md-12">
                            <div class ="card-deck">
                                <div class="card border-secondary">
                                    <img src="../<?php echo $row['menu_gambar']; ?>" class="card-img-top" width="200px" height="200px">
                                    <div class="card-img-overlay">
                                        <h6 style="margin-top:10px" class="text-light bg-info text-center rounded p-1">
                                            <?= $row['makanan_name'] ?>
                                        </h6>
                                    </div>
                                        <div class="card-body">
                                            <h4 class="card-title text-danger">Price: RP <?= number_format($row['menu_harga']); ?>/- -> RP <?= number_format($row['food_price']); ?></h4>
                                            <p>
                                                Deskripsi : <?= $row['menu_deskripsi']; ?>
                                            </p>
                                            <p>
                                                Potongan : <?= $row['potongan']; ?>
                                            </p>
                                            <p>
                                                Tanggal : <?= $row['promo_datefrom']; ?> - <?= $row['promo_dateto']; ?>
                                            </p>

                                            <?php if ($flag) { ?>
                                                <form method="POST" action="cart-delete.php">
                                                <input type="hidden" name="action" value="home">
                                                <input type="hidden" name="productCode" value="<?php echo $row['menu_id']; ?>">
                                                <input type="submit" value="Delete from cart" class="btn btn-danger btn-block">
                                                </form>
                                            <?php } else {?>
                                            <form method="POST" action="cart-add.php">
                                                <input type="hidden" name="action" value="home">
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
        </nav>
</body>
</html>
<!-- <script type="text/javascript">
    function saveCart(order_id,cust_id,id,name,harga){
        var quantity = 1;
        var total = quantity * harga;
        location.href = "cart.php?order_id="+order_id+"&cust_id="+cust_id+"&id="+id+"&name="+name+"&harga="+harga+"&quantity="+quantity+"&total="+total+"&submit=save";
    }
</script> -->
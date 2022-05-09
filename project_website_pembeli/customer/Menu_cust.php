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
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
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
                    <li><a href="">Menu</a></li>
                    <li><a href="category.php">Categories</a></li>
                    <li><a href="">Order</a></li>
                    <li><a href="">Contact Us</a></li>
                    <li><a href="">Sign Out</a></li>
                </ul>
                </div>
    </header>

    <div class="container" style="text-align: center;">
        <input type="text" placeholder="Search.." name="search" style="width: 50%;">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>

    <H1 class ="text-center text-light bg-info p-2">Product</H1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <H5  class ="text-center" >All Products</H5>
                <hr>
                    <div class="text-center">
                        <img src="image/loader.gif" id ="loader" width ="200" style ="display:none;">
                    </div>
                    <div class="row" id="result">
                        <?php 
                            $sql = "SELECT * From menu";
                            $result= $conn->query($sql);
                            while($row=$result->fetch_assoc()){
                        ?>
                        <div class="col-md-12">
                            <div class ="card-deck">
                                <div class="card border-secondary">
                                    <img src="<? $row['menu_gambar']?>"
                                    class="card-img-top">
                                    <div class="card-img-overlay">
                                        <h6 style="margin-top:175px" class="text-light bg-info text-center rounded p-1">
                                            <?= $row['makanan_name'] ?>
                                        </h6>
                                    </div>
                                        <div class="card-body">
                                            <h4 class="card-title text-danger">Price: RP <?= number_format($row['menu_harga']); ?>/-</h4>
                                            <p>
                                                Deskripsi : <?= $row['menu_deskripsi']; ?>
                                            </p>
                                            <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                        </div>
                                </div>
                            </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
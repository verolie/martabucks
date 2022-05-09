<?php
require 'Connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
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
                <ul class="nav navbar-nav navbar-right" style="font-size: 20px;"> 
                    <li><a href="Home_cust.php">Home</a></li>
                    <li><a href="Menu_cust.php">Menu</a></li>
                    <li><a href="category.php">Categories</a></li>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="Contact_us.html">Contact Us</a></li>
                    <li><a href="Logout.php">Sign Out</a></li>
                </ul>
            </div>
    </header>
    

        <div class="container" style="margin-top: 50px;">
            

            <h2 class="text-center text-white">Fill this form to confirm your order !</h2>

                <fieldset>
                    <legend>Selected Food</legend>

                    <?php  
                        error_reporting(0);
                        session_start();
                        $cust_id = $_SESSION['id'];

                        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                        $cart = json_decode($cart);
                        $total = 0;

                        
                        foreach($cart as $c){
                        ?>

            <div class="row">
            <div class="col-md-12">
                <div class="card" style="height: 200px;">
                <div class="card-body">
                        <?php
                            if($c->action == "home"){

                                $productCode = $c->menu_id;

                                $sql = "SELECT * From menu m join promosi p on m.menu_id=p.menu_id WHERE m.menu_id = '".$productCode."'";

                                $result= mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);

                                $harga = $row['food_price'];
                                $menu_name = $row['food_name'];
                                $total += $harga * $c->quantity;
                        ?>
                
                    
                        <h class="card-title"><?php echo $menu_name; ?></h>
                        <p class="card-text"><?php echo $harga * $c->quantity; ?></p>
 
                        <form method="POST" action="cart-delete.php" style="float: right; margin-left: 10px;">
                            <input type="hidden" name="productCode" value="<?php echo $productCode; ?>">
                            <button type="submit" class="btn btn-danger">
                                x
                            </button>
                        </form>
 
                        <form method="POST" action="cart-update.php" style="float: right;">
                            <input type="number" name="quantity" min="1" value="<?php echo $c->quantity;?>">
                            <input type="hidden" name="productCode" value="<?php echo $productCode;?>">
                            <input type="submit" class="btn btn-warning" value="Update">
                        </form>
 
                   
                
                    <?php
                        }
                        elseif($c->action == "menu"){

                            $productCode = $c->menu_id;
                            $sql = "SELECT * From menu Where menu_id = '".$c->menu_id."'";
                            $result= mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            
                            $harga = $row['menu_harga'];
                            $menu_name = $row['makanan_name'];
                            $total += $harga * $c->quantity;

                    ?>

                        <h class="card-title"><?php echo $menu_name; ?></h>
                        <p class="card-text"><?php echo $harga * $c->quantity; ?></p>
 
                        <form method="POST" action="cart-delete.php" style="float: right; margin-left: 10px;">
                            <input type="hidden" name="productCode" value="<?php echo $productCode; ?>">
                            <button type="submit" class="btn btn-danger">
                                x
                            </button>
                        </form>
 
                        <form method="POST" action="cart-update.php" style="float: right;">
                            <input type="number" name="quantity" min="1" value="<?php echo $c->quantity;?>">
                            <input type="hidden" name="productCode" value="<?php echo $productCode;?>">
                            <input type="submit" class="btn btn-warning" value="Update">
                        </form>
                        
                    
                    <?php
                        }
                    ?>
                         </div>
                    </div>
                </div>
                </div>
                    <?php
                        }
                    ?>

                </fieldset>
                
               
            <form method="POST" action="order_proses.php">
                    <legend>Buyer's Detail</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ailee Elowen Brinley" class="input-responsive">


                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact"  placeholder="E.g. 08xxxxxxxxxx" class="input-responsive">


                    <div class="order-label">Notes</div>
                    <input type="text" name="notes" placeholder="Notes..." class="input-responsive">

                    <div class="order-label">Tanggal Pick up</div>
                    <input type="datetime-local" name="date" >


                    <input type="hidden" name="total" value="<?php echo $total?>">
                    <input type="submit"  value="Confirm Order" class="btn btn-primary" style ="margin-top: 20;">
            </form>

        </div>

    <div id="foot-wrapper">
        <div id="footer">
            <p>
                &copy; Martabucks 2021
            </p>
        </div><!--/#footer-->
    </div><!--/#foot-wrapper--> 
        </nav>
</body>
</html>

<!-- <script type="text/javascript">
	var noti = document.querySelector('h1');
	var select = document.querySelector('.select');
	var button = document.getElementsByTagName('button');
	for(var but of button){
		but.addEventListener('click', (e)=>{
			var add = Number(noti.getAttribute('data-count') || 0);
			noti.setAttribute('data-count', add +1);
			noti.classList.add('zero')

			// image --animation to cart ---//
			var image = e.target.parentNode.querySelector('img');
			var span = e.target.parentNode.querySelector('span');
			var s_image = image.cloneNode(false);
			span.appendChild(s_image);
			span.classList.add("active");
			setTimeout(()=>{
				span.classList.remove("active");
				span.removeChild(s_image);
			}, 500); 
			

			// copy and paste //
			var parent = e.target.parentNode;
			var clone = parent.cloneNode(true);
			select.appendChild(clone);
			clone.lastElementChild.innerText = "Buy-now";
			
			if (clone) {
				noti.onclick = ()=>{
					select.classList.toggle('display');
				}	
			}
		})
	}

    function updateCart(no,harga){
        $quantity = document.getElementById('quantity'+no).value;
        $total = $quantity * harga;
        location.href = "cart.php?no="+no+"&quantity="+$quantity+"&total="+$total+"&submit=update";
    }

    function saveOrder(cust_id,subtotal){
        $nama = document.getElementById("nama").value;
        $contact = document.getElementById("contact").value;
        $notes = document.getElementById("notes").value;
        $date = document.getElementById("date").value;
        $time = document.getElementById("time").value;
        alert("Order Sukses!");
        location.href = "prosesOrder.php?cust_id="+cust_id+"&nama="+$nama+"&contact="+$contact+"&notes="+$notes+"&date="+$date+"&time="+$time+"&subtotal="+subtotal+"&submit=proses";
    }
	
</script> -->
<?php
    require 'Connection.php';

    if(isset($_POST['action'])){
        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);
        $sql = "SELECT * From `menu` m join categories c ON c.categories_id=m.categories_id WHERE categories_name !=''";

        if(isset($_POST['categories'])){
            $categories_name = implode("','", $_POST['categories']);

            $sql .="AND categories_name IN('".$categories_name."')";
        }

        $result = $conn->query($sql);
        $output='';

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){

                $flag = false;
                                 foreach($cart as $c){
                                     if($c->menu_id == $row['menu_id']){
                                         $flag = true;
                                         break;
                                     }
                }

                if($flag){
                    $output .= '
                <div class="col-md-4 mb-2">
                <div class ="card-deck">
                    <div class="card border-secondary">
                        <img src=" '.$row['menu_gambar'].'"
                        class="card-img-top">
                        <div class="card-img-overlay">
                            <h6 style="margin-top:175px" class="text-light bg-info text-center rounded p-1">
                                '.$row['makanan_name'].'
                            </h6>
                        </div>
                            <div class="card-body">
                                <h4 class="card-title text-danger">Price: RP  '.number_format($row['menu_harga']).'/-</h4>
                                <p>
                                    Deskripsi : '.$row['menu_deskripsi'].'
                                </p>
                                    <form method="POST" action="cart-delete.php">
                                    <input type="hidden" name="action" value="menu">
                                    <input type="hidden" name="productCode" value="<?php echo '.$row['menu_id'].'; ?>">
                                    <input type="submit" value="Delete from cart" class="btn btn-danger btn-block">
                                    </form>
                            </div>
                    </div>
                </div>
        </div>';

                }
                else{

                    $output .= '
                <div class="col-md-4 mb-2">
                <div class ="card-deck">
                    <div class="card border-secondary">
                        <img src=" '.$row['menu_gambar'].'"
                        class="card-img-top">
                        <div class="card-img-overlay">
                            <h6 style="margin-top:175px" class="text-light bg-info text-center rounded p-1">
                                '.$row['makanan_name'].'
                            </h6>
                        </div>
                            <div class="card-body">
                                <h4 class="card-title text-danger">Price: RP  '.number_format($row['menu_harga']).'/-</h4>
                                <p>
                                    Deskripsi : '.$row['menu_deskripsi'].'
                                </p>
                                 <form method="POST" action="cart-add.php">
                                 <input type="hidden" name="action" value="menu">
                                 <input type="hidden" name="productCode" value="<?php echo '.$row['menu_id'].';?>">
                                 <input type="submit" value="Add to cart" class="btn btn-success btn-block">
                                </form>
                            </div>
                    </div>
                </div>
        </div>';
                }
                
            }
        }else{
            $output="<h3>No Product Found</h3>";
        }
        echo $output;
    }


?>
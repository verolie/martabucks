<?php
    require 'Connection.php';

    if(isset($_POST['action'])){
        $sql = "SELECT * From menu m join categories c ON c.categories_id=m.id_categories WHERE categories_name !=''";

        if(isset($_POST['categories'])){
            $categories_name = implode("','", $_POST['categories']);

            $sql .="AND categories_name IN('".$categories_name."')";
        }

        $result = $conn->query($sql);
        $output='';

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $output .= '<div class="col-md-4 mb-2">
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
                                <a href="#" class="btn btn-success btn-block">Add to cart</a>
                            </div>
                    </div>
                </div>
        </div>';
            }
        }else{
            $output="<h3>No Product Found</h3>";
        }
        echo $output;
    }


?>
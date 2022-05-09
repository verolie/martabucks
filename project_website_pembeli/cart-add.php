<?php

include "Connection.php";

$quantity = 1;
$productCode = $_POST["productCode"];
$action = $_POST["action"];




$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

    // $harga = $row['menu_harga'];
    // $makanan_name = $row['makanan_name'];

    array_push($cart, array(
     "menu_id" => $productCode,
     "quantity" => $quantity,
     "action" => $action
     ));
     

     setcookie("cart", json_encode($cart));


header("Location: order.php");

// $productCode = $_POST['id'];

// $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
// $cart = json_decode($cart);

// array_push($cart, array(
//     $_GET['order_id'] => $order_id,
//     $_GET['no'] => $no,
//     $_GET['id'] => $id,
//     $_GET['cust_id'] => $cust_id,
//     $_GET['name'] => $name,
//     $_GET['harga'] => $harga,
//     $_GET['quantity'] => $quantity,
//     $_GET['total'] => $total
// ));

// setcookie("cart", json_encode($cart));
// header("Location: order.php")

// // if($submit == 'save'){
// //     $sql = "insert into cart (order_id,cust_id,menu_id,nama_menu,harga,quantity,total) values('$order_id','$cust_id','$id','$name','$harga','$quantity','$total')";
// //     $query = mysqli_query($conn,$sql);
// //     header('location:order.php');
// // }else if($submit == 'update'){
// //     $sql = "update cart set quantity='$quantity', total = '$total' where cart_id = '$no'";
// //     $query = mysqli_query($conn,$sql);
// //     header('location:order.php');
// // }
?>
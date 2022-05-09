<?php

try {
require 'Connection.php';
error_reporting(0); session_start();

$cust_id = $_SESSION['id'];
$name = $_POST["full-name"];
$phone = $_POST["contact"];
$note = $_POST["notes"];

$pickup = $_POST["date"];
$datepick = new DateTime($pickup);
$datepickup = $datepick->format("Y-m-d H:i:s");

$total = $_POST["total"];

$sql = "INSERT into order_detail (total_harga,status_id) values('".$total."','1')";
$query = mysqli_query($conn,$sql);


date_default_timezone_set('Asia/Jakarta');
$dateorder = date('Y-m-d H:i:s', time());

$sql1 = "SELECT * from order_detail";
$query1 = mysqli_query($conn,$sql1);
$no_detail=  mysqli_num_rows($query1);

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

foreach($cart as $c){
    $id_menu = $c->menu_id;
    $quantity = $c->quantity;
    $sql = "INSERT INTO `order` (cust_id,order_detail_id,order_name,order_phone,order_notes,order_time,order_pickup,menu_id,jumlah_order,status_id) 
    VALUES('$cust_id','$no_detail','$name','$phone','$note','$dateorder','$datepickup','$id_menu','$quantity','1')";
    $query_order = mysqli_query($conn,$sql);
}

setcookie("cart", "", time() - 3600);

echo "<script>alert('Berhasil order')</script>";
echo "<script> window.location.href = 'order.php';</script>";

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
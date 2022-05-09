<?php
 
$productCode = $_POST["productCode"];
$quantity = $_POST["quantity"];
 
$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);
 
foreach ($cart as $c)
{
    if ($c->menu_id == $productCode)
    {
        $c->quantity = $quantity;
    }
}
 
setcookie("cart", json_encode($cart));
header("Location: order.php");
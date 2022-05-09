<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$k = new PDO("mysql:host=localhost;dbname=project_website", "root", "");

$sql = "INSERT INTO customer ( cust_name, cust_email, cust_phone, cust_gender, cust_password) VALUES (?, ?,?,?,?)";

$result = $k -> prepare($sql);
$result->execute([$name, $email, $phone, $gender, $password]);

include('index.php');
header('Location: index.php');
?>


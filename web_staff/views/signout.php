<?php
session_start();

$_SESSION['email'] 		= '';
$_SESSION['id'] 		= '';
$_SESSION['name'] 		= '';
$_SESSION['address'] 	= '';
$_SESSION['phone'] 		= '';


unset($_SESSION['email']);
unset($_SESSION['id'] );
unset($_SESSION['name']);
unset($_SESSION['address']);
unset($_SESSION['phone']);

session_unset();
session_destroy();
echo "<script>alert('Berhasil Logout');window.location.href='../../index.php'</script>";

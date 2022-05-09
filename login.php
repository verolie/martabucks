<?php
session_start();

$email = $_POST['email'];
$password = $_POST['pass'];
$password_staff = md5($_POST['pass']);

$k = new PDO("mysql:host=localhost;dbname=project_website", "root", "");

$sqlCustomer = "SELECT * FROM customer WHERE cust_email = ?";

$resultcust = $k->prepare($sqlCustomer);
$resultcust->execute([$email]);

// Buat Login Staff
$sqlStaff = "SELECT * FROM staff WHERE staff_email = :emails AND staff_password = :passwords";

$resultstaff = $k->prepare($sqlStaff);
$resultstaff->bindParam(':emails', $email);
$resultstaff->bindParam(':passwords', $password_staff);
$resultstaff->execute();
// ----------------------------------------------------

if($row = $resultcust->fetch()){
    if(password_verify($password, $row['cust_password'])){
        $_SESSION['email'] = $row['cust_email'];
        $_SESSION['id'] = $row['cust_id'];
        $_SESSION['name'] = $row['cust_name'];
        $_SESSION['phone'] = $row['cust_phone'];
        $_SESSION['gender'] = $row['cust_gender'];
        header('Location: http://localhost/web_fix2/project_website_pembeli/Home_cust.php');
    }
    else{
        header('Location: index.php');
    }   
}elseif($row = $resultstaff->fetch()) {
    if($password_staff == $row['staff_password']){
        $_SESSION['email'] = $row['staff_email'];
        $_SESSION['id'] = $row['job_id'];
        $_SESSION['staff_id'] = $row['staff_id'];
        $_SESSION['name'] = $row['staff_name'];
        $nama = $_SESSION['name'];
        $_SESSION['address'] = $row['staff_address'];
        $_SESSION['phone'] = $row['staff_phone'];
        if ($_SESSION['id'] == 1) {
            echo "<script>alert('Selamat datang Admin $nama')</script>";
            echo "<script> window.location.href = 'web_staff/views/';</script>";   
        }else{
            echo "<script>alert('Selamat datang Staff $nama')</script>";
            echo "<script> window.location.href = 'web_staff/views/';</script>";   
        }    
    }else{
        echo "<script>alert('Email atau Password salah')</script>";
        echo "<script> window.location.href = 'index.php';</script>";  
    }   
 
}else{
    echo "<script>alert('Email atau Password salah')</script>";
    echo "<script> window.location.href = 'index.php';</script>";  
}
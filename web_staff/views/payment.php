<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$id_staff = $_SESSION['staff_id'];
$id_job = $_SESSION['id'];
// koneksi DB
require_once'../functions.php';
$pdo = koneksiDB();
// $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// trigger_error("PDO errorInfo: ".$pdo->errorInfo());

// SQL
$sql = "SELECT
            transaksi.transaksi_id AS id,
            transaksi.order_detail_id AS orderid,
            transaksi.total_transaksi AS total,
            staff.staff_name AS staffname,
            metode_pembayaran.jenis_pembayaran AS pay
        FROM transaksi
        JOIN metode_pembayaran
        ON transaksi.detail_pembayaran_id = metode_pembayaran.metode_pembayaran_id
        JOIN staff
        ON transaksi.staff_id = staff.staff_id";

// prepare & execute
$hasil = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Martabucks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
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
        .dropdown{
            margin: 20px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
    <header class = "header">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Profile
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                <li data-toggle="modal" data-target="#exampleModal"><a href="#">Profile</a></li>
                <li><a href="signout.php">Log out</a></li>
            </ul>
        </div>
        <nav class = "navbar navbar-style">
            <div class="container">
                <div class = "navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="home.php"><img class ="logo" src="logonew.png"></a>
                </div>
                <div class="collapse navbar-collapse" id = "micon">
                <ul class="nav navbar-nav navbar-right"> 
                    <li><a href="home.php">Beranda</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="pesanan.php">Pesanan</a></li>
                    <li><a href="payment.php">Pembayaran</a></li>
                    <li><a href="promo.php">Promosi</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                </ul>
                </div>
    </header>

        <div class="page-header clearfix">
            <h2 class="pull-left">Record Pembayaran
                <span class='glyphicon glyphicon-folder-open'></span>
            </h2>
        </div>

        <div class="table-responsive mt-3">
        <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Order ID</th>
            <th>Total</th>
            <th>Nama Staff</th>
            <th>Metode Pembayaran</th>
        </tr>

        <?php
        $i = 0;
        while($row = $hasil->fetch()):
        $i++
        ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['orderid']; ?></td>
            <td><?= $row['total']; ?></td>
            <td><?= $row['staffname']; ?></td>
            <td><?= $row['pay']; ?></td>
        </tr>
        <?php endwhile; ?>
        </table>
    </div>
</body>
<?php include 'show-profile.php'; ?>
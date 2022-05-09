<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$id_staff = $_SESSION['staff_id'];
// koneksi DB
require '../functions.php';
$pdo = koneksiDB();
// $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// trigger_error("PDO errorInfo: ".$pdo->errorInfo());

// SQL
$sql = "SELECT 
        od.order_detail_id, 
        of.order_name, 
        of.order_phone, 
        of.order_notes, 
        of.order_time, 
        of.order_pickup, 
        od.total_harga, 
        of.status_id 
        FROM `order_detail` AS od 
        JOIN `order` as of 
        on od.order_detail_id = of.order_detail_id";

// prepare & execute
$hasil = $pdo->query($sql);

$query = "SELECT * FROM metode_pembayaran";
$data = $pdo->query($query);

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
            <h2 class="pull-left">Daftar Pesanan
                <span class='glyphicon glyphicon-list-alt'></span>
            </h2>
        </div>

        <div class="table-responsive mt-3">
        <table class="table table-hover">
        <tr>
            <th>ID Order</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Notes</th>
            <th>Waktu Order</th>
            <th>Pengambilan Order</th>
            <th>Total</th>
            <th>Status</th>
        </tr>

        <?php
        $i = 0;
        while($row = $hasil->fetch()):
        $i++
        ?>
        <tr>
            <td><?= $row['order_detail_id']; ?></td>
            <td><?= $row['order_name']; ?></td>
            <td><?= $row['order_phone']; ?></td>
            <td><?= $row['order_notes']; ?></td>
            <td><?= $row['order_time']; ?></td>
            <td><?= $row['order_pickup']; ?></td>
            <td><?= $row['total_harga']; ?></td>
            <td class="hidden"><?= $row['total_harga']; ?></td>
            <td>
                <?php if ($row['status_id'] == 1): ?>
                    <a href="../proses/pesananpro.php?action=update&id=<?= $row['order_detail_id']; ?>" onclick="return confirm('Pesanan Akan Diterima?')">
                            <p class="btn btn-primary btn-sm">Terima</p>
                        </a>
                <?php endif ?>

                <?php if ($row['status_id'] == 2): ?>
                     <button type="button" class="btn btn-warning btn-sm editbtn">Proses</button>
                <?php endif ?>

                <?php if ($row['status_id'] == 3): ?>
                     <button type="button" class="btn btn-success btn-sm">Selesai</button>
                <?php endif ?>
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
    </div>
</body>
<?php include 'show-profile.php'; ?>
<?php include 'show-detailpesanan.php'; ?>

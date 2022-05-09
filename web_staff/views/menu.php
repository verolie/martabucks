<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$id_staff = $_SESSION['staff_id'];
$id_job = $_SESSION['id'];
// koneksi DB
require '../functions.php';
$pdo = koneksiDB();

// SQL
$sql = "SELECT
            menu.menu_id AS id,
            menu.makanan_name AS nama,
            menu.menu_gambar AS gambar,
            categories.categories_name AS cat,
            menu.menu_harga AS harga,
            menu.menu_deskripsi AS deskripsi
        FROM menu
        JOIN categories
        ON menu.categories_id = categories.categories_id";

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
        .gambar{
            height: 75px;
            widows: 75px;
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
            <h2 class="pull-left">Daftar Menu
                <span class='glyphicon glyphicon-cutlery'></span>
            </h2>
            <?php if ($id_job == 1): ?>
                <a href="form-menu.php?action=add" class="btn btn-success pull-right">Tambah Menu
                    <span class='glyphicon glyphicon-plus-sign'></span>
                </a>
            <?php endif ?>
            
        </div>

        <div class="table-responsive mt-3">
        <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $i = 0;
        while($row = $hasil->fetch()):
        $i++
        ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td>
                <?php if ($row['gambar'] == NULL): ?>
                    <p style="color: red">No Image</p>
                <?php else: ?>
                    <img src="../<?= $row['gambar'] ?>" class="gambar" alt="">
                <?php endif ?>
                
            </td>
            <td><?= $row['cat']; ?></td>
            <td><?= $row['harga']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td>
                <?php if ($id_job == 1): ?>
                    <a href="form-menu.php?action=edit&id=<?= $row['id']; ?>" title='Edit Data' data-toggle='tooltip'>
                        <span class='glyphicon glyphicon-edit'></span>
                    </a>
                    <a href="../proses/menupro.php?action=delete&id=<?= $row['id']; ?>" title='Hapus Data' data-toggle='tooltip' onclick="return confirm('Yakin Ingin menghapus Menu?')">
                        <span class='glyphicon glyphicon-trash'></span>
                    </a>
                <?php else: ?>
                    <p style="color: red">No Access</p>
                <?php endif ?>
                
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
    </div>
</body>
<?php include 'show-profile.php'; ?>
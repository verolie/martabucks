<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$action = $_GET['action'];


if($action == "add"){
    $page_title = "Buat Menu Baru";
    $nama = "";
    $kategori = "";
    $harga = "";
    $desc = "";

}elseif($_GET['action'] == "edit"){
    $page_title = "Edit Data Menu";

    include_once '../functions.php';
    $pdo = koneksiDB();

    $sql = "SELECT
            menu.menu_id,
            menu.makanan_name,
            menu.menu_gambar,
            categories.categories_name,
            categories.categories_id,
            menu.menu_harga,
            menu.menu_deskripsi
            FROM menu
            JOIN categories
            ON menu.categories_id = categories.categories_id
            WHERE menu.menu_id = ?";

    $hasil = $pdo->prepare($sql);
    $hasil->execute([$_GET['id']]);
    $row = $hasil->fetch();

    $id = $row['menu_id'];
    $nama = $row['makanan_name'];
    $gambar = $row['menu_gambar'];
    $cat_id = $row['categories_id'];
    $kategori = $row['categories_name'];
    $harga = $row['menu_harga'];
    $desc = $row['menu_deskripsi'];
}

include_once '../functions.php';
$pdo = koneksiDB();

//sql
$sql = "SELECT * FROM categories";

//prepare & execute
$hasil = $pdo->query($sql);

?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"> </script>
<script src="autoNumeric-(with latest version).js" type=text/javascript> </script>
<style type="text/css">
        .wrapper{
            max-width: 500px;
            margin: auto;
            margin-top: 20px;

        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .gambar{
            height: 200px;
            widows: 200px;
        }
</style>

<div class="wrapper">
<h1 class="h2 mt-3"><?= $page_title; ?></h1>
<form action="../proses/menupro.php?action=<?= $action; ?>"
    method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id; ?>" class="form-control" />
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $nama; ?>" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Gambar</label>
        <input type="file" name="menu_gambar"/>
        <?php if ($action == "edit"): ?>
             <img src="../<?= $gambar ?>" class="gambar" alt="">
        <?php endif ?>
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <?php if ($action == "edit"): ?>
            <select name="kategori" value="<?= $kategori; ?>" class="form-control" required>
                <option value="<?= $row['categories_id'] ?>"><?= $row['categories_name'] ?> </option>
                <?php while($categories = $hasil->fetch()): ?>
                <option value="<?= $categories['categories_id'] ?>"><?= $categories['categories_name'] ?></option>
                <?php endwhile; ?>
            </select>
        <?php else: ?>
            <select name="kategori" value="<?= $kategori; ?>" class="form-control" required>
                <option value="">--------Pilih---------</option> 
                <?php while($categories = $hasil->fetch()): ?>
                <option value="<?= $categories['categories_id'] ?>"><?= $categories['categories_name'] ?></option>
                <?php endwhile; ?>
            </select>
        <?php endif ?>
        
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga" value="<?= $harga; ?>" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="desc" value="<?= $desc; ?>" class="form-control" required />
    </div>
    <button type="submit" name="btn-save" class="btn btn-success pull-right"> Simpan 
        <span class='glyphicon glyphicon-floppy-disk'></span></button>
</form>


</div>
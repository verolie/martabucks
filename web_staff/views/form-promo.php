<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$action = $_GET['action'];

if($action == "add"){
    $page_title = "Tambah Promo Baru";
    $potongan = "";
    $awal = "";
    $akhir = "";
    $harga = "";
    $nama = "";

}elseif($_GET['action'] == "edit"){
    $page_title = "Edit Data Promo";

    include_once '../functions.php';
    $pdo = koneksiDB();

    $sql = "SELECT
                promosi.potongan AS potongan,
                promosi.promo_datefrom AS awal,
                promosi.promo_dateto AS akhir,
                promosi.food_price AS harga,
                menu.makanan_name AS nama,
                menu.menu_id AS menu_id,
                promosi.promo_id AS id
            FROM promosi
            JOIN menu
            ON promosi.menu_id = menu.menu_id
            WHERE promosi.promo_id = ?";

    $hasil = $pdo->prepare($sql);
    $hasil->execute([$_GET['id']]);
    $row = $hasil->fetch();

    $id = $row['id'];
    $menu_id = $row['menu_id'];
    $potongan = $row['potongan'];
    $awal = $row['awal'];
    $akhir = $row['akhir'];
    $harga = $row['harga'];
    $nama = $row['nama'];
}

include_once '../functions.php';
$pdo = koneksiDB();

//sql
$sql = "SELECT * FROM menu";

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
</style>

<div class="wrapper">
<h1 class="h2 mt-3"><?= $page_title; ?></h1>
<form action="../proses/promopro.php?action=<?= $action; ?>"
    method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id; ?>" class="form-control" />
    <div class="form-group">
        <label>Potongan</label>
        <input type="number" name="potongan" value="<?= $potongan; ?>" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Masa Berlaku Dari</label>
        <input type="date" name="awal" value="<?= $awal; ?>" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Masa Berlaku Sampai</label>
        <input type="date" name="akhir" value="<?= $akhir; ?>" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Harga Menu (excl. promo)</label>
        <input type="number" name="harga" value="<?= $harga; ?>" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Nama Menu</label>
        <?php if ($action == "edit"): ?>
            <select name="nama" value="" class="form-control" required>
                <option value="<?= $menu_id ?>"><?= $nama ?> </option>
                <?php while($menu = $hasil->fetch()): ?>
                <option value="<?= $menu['menu_id'] ?>"><?= $menu['makanan_name'] ?></option>
            <?php endwhile; ?>
            </select>
        <?php else: ?>
            <select name="nama" value="" class="form-control" required>
                <option value="">--------Pilih---------</option> 
                <?php while($menu = $hasil->fetch()): ?>
                    <option value="<?= $menu['menu_id'] ?>"><?= $menu['makanan_name'] ?></option>
                <?php endwhile; ?>
            </select>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-success pull-right"> Simpan 
        <span class='glyphicon glyphicon-floppy-disk'></span></button>
</form>


</div>
<?php

$action = $_GET['action'];

require '../functions.php';
//koneksi
$pdo = koneksiDB();

if($action == "add"){
    //INSERT DATA
    //SQL
    $awal = strtotime($_POST['awal']);
    $akhir = strtotime($_POST['akhir']);
    if ($awal < $akhir) {
        $sql = "INSERT INTO promosi (menu_id, food_price, potongan, promo_datefrom, promo_dateto)
        VALUES(?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $data = [
            $_POST['nama'],
            $_POST['harga'],
            $_POST['potongan'],
            $_POST['awal'],
            $_POST['akhir']
        ];

        $stmt->execute($data);
        echo "<script>alert('Berhasil Menambah Promo')</script>";
        echo "<script> window.location.href = '../views/promo.php';</script>";
    }else{
        echo "<script>alert('Tanggal awal lebih besar dari tanggal akhir')</script>";
        echo "<script> window.location.href = '../views/promo.php';</script>"; 
    }

}elseif($_GET['action'] == "edit"){

    $id = $_POST['id'];
    $potongan = $_POST['potongan'];
    $awal = strtotime($_POST['awal']);
    $akhir = strtotime($_POST['akhir']);
    $awal1 = $_POST['awal'];
    $akhir2 = $_POST['akhir'];
    $harga = $_POST['harga'];
    $menu_id = $_POST['nama'];

    if ($awal < $akhir) {
        $sql = "UPDATE promosi
                SET menu_id = :menu_id,
                potongan = :potongan,
                food_price = :harga,
                promo_datefrom = :awal,
                promo_dateto = :akhir
                WHERE promo_id = $id
                ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':menu_id', $menu_id);
        $stmt->bindParam(':potongan', $potongan);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':awal', $awal1);
        $stmt->bindParam(':akhir', $akhir2);
        $stmt->execute();
        echo "<script>alert('Berhasil Mengubah Promo')</script>";
        echo "<script> window.location.href = '../views/promo.php';</script>";
    }else{
        echo "<script>alert('Tanggal awal lebih besar dari tanggal akhir')</script>";
        echo "<script> window.location.href = '../views/promo.php';</script>";    
    }

}elseif($_GET['action'] == "delete"){
    $sql = "DELETE FROM promosi
    WHERE promo_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    echo "<script>alert('Berhasil Menghapus Promo')</script>";
    echo "<script> window.location.href = '../views/promo.php';</script>";
}
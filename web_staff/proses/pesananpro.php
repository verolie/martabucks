<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}

$action = $_GET['action'];

require '../functions.php';
//koneksi
$pdo = koneksiDB();

if($_GET['action'] == "update"){
	if ($_GET['action'] == "update") {
		$sql = "UPDATE `order` SET 
           		status_id = '2' 
            	WHERE order_detail_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$_GET['id']]);
	}
	if ($_GET['action'] == "update") {
		$sql1 = "SELECT * FROM `order` WHERE order_detail_id = ?";
		$stmt1 = $pdo->prepare($sql1);
		$stmt1->execute([$_GET['id']]);
		$row = $stmt1->fetch();		

		$order_id = $row['order_detail_id'];
		$total = $row['total'];
		$status = $row['status_id'];

		$sql2 = "INSERT INTO order_detail (order_detail_id, total_harga, status_id) VALUES (?, ?, ?)";
		$stmt2 = $pdo->prepare($sql2);
        $data = [
            $order_id,
            $total,
            $status
        ];
        $stmt2->execute($data);
	}

	echo "<script>alert('Berhasil Diterima')</script>";
    echo "<script> window.location.href = '../views/pesanan.php';</script>";
    
}
elseif ($_GET['action'] == "cekout") {
    if ($_GET['action'] == "cekout") {
    	$order_detail_id = $_POST['id_order'];
    	$detail_pembayaran_id =$_POST['tipe_pembayaran'];
    	$total_transaksi = $_POST['total2'];
    	$staff_id = $_POST['staff_id'];

    	$sql = "INSERT INTO transaksi (order_detail_id, detail_pembayaran_id, total_transaksi, staff_id) VALUES (?, ?, ?, ?)";
    	$stmt = $pdo->prepare($sql);
        $data = [
            $order_detail_id,
            $detail_pembayaran_id,
            $total_transaksi, 
            $staff_id
        ];
        $stmt->execute($data);
    }

    if ($_GET['action'] == "cekout") {
    	$order_detail_id1 = $_POST['id_order'];

    	$sql1 = "UPDATE `order` SET 
           		status_id = '3' 
            	WHERE order_detail_id = $order_detail_id1";
    	$stmt1 = $pdo->prepare($sql1);
        $stmt1->execute();
    }
    if ($_GET['action'] == "cekout") {
    	$order_detail_id2 = $_POST['id_order'];

    	$sql2 = "UPDATE order_detail SET 
           		status_id = '3' 
            	WHERE order_detail_id = $order_detail_id2";
    	$stmt2 = $pdo->prepare($sql2);
        $stmt2->execute();
    }
    echo "<script>alert('Berhasil CheckOut')</script>";
    echo "<script> window.location.href = '../views/pesanan.php';</script>";
}
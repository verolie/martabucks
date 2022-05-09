<?php

$action = $_GET['action'];

require '../functions.php';
//koneksi
$pdo = koneksiDB();

if($action == "add"){
    //INSERT DATA
    //SQL
    $sql = "INSERT INTO staff (job_id, staff_name, staff_email, staff_password, staff_address, staff_phone)
            VALUES(?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $data = [
        $_POST['jabatan'],
        $_POST['nama'],
        $_POST['email'],
        MD5($_POST['password']),
        $_POST['alamat'],
        $_POST['telp']
    ];

    $stmt->execute($data);
    echo "<script>alert('Berhasil Menambah Staff')</script>";
    echo "<script> window.location.href = '../views/staff.php';</script>";

}elseif($_GET['action'] == "edit"){
    $password2 = $_POST['password2'];
    if ($password2 == NULL) {
        $id = $_POST['id'];
        $job_id = $_POST['jabatan'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $sql = "UPDATE staff
                SET job_id = :job_id,
                    staff_name = :nama,
                    staff_email = :email,
                    staff_address = :alamat,
                    staff_phone = :telp
                WHERE staff_id = $id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':job_id', $job_id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telp', $telp);
        $stmt->execute();
        echo "<script>alert('Berhasil Mengubah Staff')</script>";
        echo "<script> window.location.href = '../views/staff.php';</script>";
    }else{
        $id = $_POST['id'];
        $job_id = $_POST['jabatan'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = MD5($_POST['password2']);
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $sql = "UPDATE staff
                SET job_id = :job_id,
                    staff_name = :nama,
                    staff_email = :email,
                    staff_password = :password,
                    staff_address = :alamat,
                    staff_phone = :telp
                WHERE staff_id = $id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':job_id', $job_id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telp', $telp);
        $stmt->execute();
        echo "<script>alert('Berhasil Mengubah Staff')</script>";
        echo "<script> window.location.href = '../views/staff.php';</script>";
    }
    

}elseif($_GET['action'] == "delete"){
    $sql = "DELETE FROM staff
            WHERE staff_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    echo "<script>alert('Berhasil Menghapus Staff')</script>";
    echo "<script> window.location.href = '../views/staff.php';</script>";
}
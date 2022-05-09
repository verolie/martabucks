<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$action = $_GET['action'];

if($action == "add"){
    $page_title = "Tambah Staff Baru";
    $jabatan = "";
    $nama = "";
    $email = "";
    $pw = "";
    $alamat = "";
    $telp = "";

}elseif($_GET['action'] == "edit"){
    $page_title = "Edit Data Staff";

    include_once '../functions.php';
    $pdo = koneksiDB();

    $sql = "SELECT
            staff.staff_id AS id,
            staff.staff_name AS nama,
            staff.staff_email AS email,
            staff.staff_address AS alamat,
            staff.staff_phone AS telp,
            job.job_name AS jabatan,
            job.job_id,
            staff.staff_password AS pw
    FROM staff
    JOIN job
    ON staff.job_id = job.job_id
    WHERE staff.staff_id = ?";

    $hasil = $pdo->prepare($sql);
    $hasil->execute([$_GET['id']]);
    $row = $hasil->fetch();

    $id = $row['id'];
    $jabatan = $row['jabatan'];
    $nama = $row['nama'];
    $email = $row['email'];
    $alamat = $row['alamat'];
    $telp = $row['telp'];
    $password = $row['pw'];
}

include_once '../functions.php';
$pdo = koneksiDB();

//sql
$sql = "SELECT * FROM job";

//prepare & execute
$hasil = $pdo->query($sql);

?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
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
<script>
    showHide = () => {
        let x = document.getElementById("password");
        let y = document.getElementById("toggle");

        if (x.type === "password")
        {
            x.type = "text";
            y.className = "fas fa-eye-slash";
        }
        else
        {
            x.type = "password";
            y.className = "fas fa-eye";
        }
    }
</script>

<div class="wrapper">
    <h1 class="h2 mt-3"><?= $page_title; ?></h1>
    <form action="../proses/staffpro.php?action=<?= $action; ?>"
        method="post"
        enctype="multipart/form-data">

        <div class="form-group">
            <label>Kategori</label>
            <input type="hidden" name="id" value="<?= $id; ?>" class="form-control" />
            <?php if ($action == "edit"): ?>
                    <select name="jabatan" value="" class="form-control" required>
                        <option value="<?= $row['job_id']?>"><?= $jabatan ?></option> 
                        <?php while($job = $hasil->fetch()): ?>
                            <option value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
            <?php else: ?>
                    <select name="jabatan" value="" class="form-control" required>
                        <option value="">--------Pilih---------</option> 
                        <?php while($job = $hasil->fetch()): ?>
                            <option value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="<?= $nama; ?>" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?= $email; ?>" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Password</label>
                <?php if ($action == "edit"): ?>
                    <label>Input New Password</label>
                    <input type="password" class="form-control" name="password2" id="password" value="">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="showHide()"><i class="fas fa-eye" id="toggle"></i></button>
                    </div>
                    <p style="color: orange;">Password Kosongkan jika tidak ingin diubah</p>
                <?php else: ?>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="showHide()"><i class="fas fa-eye" id="toggle"></i></button>
                </div>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="number" name="telp" value="<?= $telp; ?>" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-success pull-right"> Simpan 
                <span class='glyphicon glyphicon-floppy-disk'></span></button>
            </form>
        </div>
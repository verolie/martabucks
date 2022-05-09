<?php

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
WHERE staff.staff_id = $id_staff";

$hasil = $pdo->prepare($sql);
$hasil->execute();
$row = $hasil->fetch();

$id = $row['id'];
$jabatan = $row['jabatan'];
$nama = $row['nama'];
$email = $row['email'];
$alamat = $row['alamat'];
$telp = $row['telp'];
$password = $row['pw'];

include_once '../functions.php';
$pdo = koneksiDB();

//sql
$sql = "SELECT * FROM job";

//prepare & execute
$hasil = $pdo->query($sql);
$action = 'edit';

?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Profile</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form action="../proses/staffpro.php?action=<?= $action; ?>"
        method="post"
        enctype="multipart/form-data">

        <div class="form-group">
            <label>Jabatan</label>
            <input type="hidden" name="id" value="<?= $id; ?>" class="form-control" />
            <input type="text" name="jabatan" value="<?= $jabatan; ?>" class="form-control" id="jabatan" required />
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $nama; ?>" class="form-control" id="nama" required />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?= $email; ?>" class="form-control" id="email" required />
        </div>
        <div class="form-group">
            <label>Password</label>
                <label>Input New Password</label>
                <input type="password" class="form-control" name="password2" id="password" value="">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="showHide()"><i class="fas fa-eye" id="toggle"></i></button>
                </div>
                <p style="color: orange;">Password Kosongkan jika tidak ingin diubah</p>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="<?= $alamat; ?>" id="alamat" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="number" name="telp" value="<?= $telp; ?>" id="telp" class="form-control" required />
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning update">Update</button>
            <button type="button" class="btn btn-danger cancle">Cancle</button>
            <button type="submit" class="btn btn-success simpan"> Simpan 
                <span class='glyphicon glyphicon-floppy-disk'></span>
            </button>
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
            
        </div>
        </form>
    </div>
</div>
</div>

    <script>
            $(function () {
                //input tanggal

                $(".simpan").hide();
                $(".cancle").hide();

                $("#jabatan").prop("readonly", true);
                $("#nama").prop("readonly", true);
                $("#email").prop("readonly", true);
                $("#password").prop("readonly", true);
                $("#alamat").prop("readonly", true);
                $("#telp").prop("readonly", true);            

                $(".update").click(function(){                    
                    $("#nama").prop("readonly", false);
                    $("#email").prop("readonly", false);
                    $("#password").prop("readonly", false);
                    $("#alamat").prop("readonly", false);
                    $("#telp").prop("readonly", false); 
                    $(".simpan").show();
                    $(".cancle").show();
                    $(".update").hide();
                });

                $(".cancle").click(function(){                
                    $("#nama").prop("readonly", true);
                    $("#email").prop("readonly", true);
                    $("#password").prop("readonly", true);
                    $("#alamat").prop("readonly", true);
                    $("#telp").prop("readonly", true);   
                    $(".simpan").hide();
                    $(".cancle").hide();
                    $(".update").show();
                });
            })

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
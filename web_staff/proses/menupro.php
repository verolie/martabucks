<?php

$action = $_GET['action'];

require '../functions.php';
//koneksi
$pdo = koneksiDB();

if($action == "add"){
    //INSERT DATA
    //SQL
    $sql = "INSERT INTO menu (makanan_name, menu_gambar, categories_id, menu_harga, menu_deskripsi)
    VALUES(?, ?, ?, ?, ?)";

    //CEK FOTO
    $stmt = $pdo->prepare($sql);
    $ext_boleh = ["jpg", "png", "jpeg"];
    if(checkFile($_FILES['menu_gambar'], $ext_boleh)){
        // proses upload
        $ext = getFileExt($_FILES['menu_gambar']);
        $temp = $_FILES['menu_gambar']['tmp_name'];
        $permanent_path = "../gambar/" . $_POST['nama'] . "." . $ext;
        $file_path = "gambar/" . $_POST['nama'] . "." . $ext;

        if(!file_exists("../gambar")){
            mkdir("../gambar");
        }

        move_uploaded_file($temp, $permanent_path);

        $data = [
            $_POST['nama'],
            $file_path,
            $_POST['kategori'],
            $_POST['harga'],
            $_POST['desc']
        ];
    }else{
        $data = [
            $_POST['nama'],
            NULL,
            $_POST['kategori'],
            $_POST['harga'],
            $_POST['desc']
        ];
    }

    $stmt->execute($data);
    echo "<script>alert('Berhasil Menambah Menu')</script>";
    echo "<script> window.location.href = '../views/menu.php';</script>";

}elseif($_GET['action'] == "edit"){

    if(isset($_POST['btn-save'])){

        $ext_boleh = ["jpg", "png", "jpeg"];
        if(checkFile($_FILES['menu_gambar'], $ext_boleh)){
            // proses upload
            $ext = getFileExt($_FILES['menu_gambar']);
            $temp = $_FILES['menu_gambar']['tmp_name'];
            $permanent_path = "../gambar/" . $_POST['nama'] . "." . $ext;
            $file_path = "gambar/" . $_POST['nama'] . "." . $ext;

            if(!file_exists("../gambar")){
                mkdir("../gambar");
            }

            move_uploaded_file($temp, $permanent_path);

            $nama = $_POST['nama'];
            $gambar = $file_path;
            $kategori = $_POST['kategori'];
            $harga = $_POST['harga'];
            $desc = $_POST['desc'];
            $id = $_POST['id'];
            $sql = "UPDATE menu
            SET makanan_name = :nama,
            menu_gambar = :gambar,
            categories_id = :cat,
            menu_harga = :harga,
            menu_deskripsi = :deskripsi
            WHERE menu_id = $id
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':gambar', $gambar);
            $stmt->bindParam(':cat', $kategori);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':deskripsi', $_POST['desc']);
            $stmt->execute();
            echo "<script>alert('Berhasil Mengubah Menu')</script>";
            echo "<script> window.location.href = '../views/menu.php';</script>";
        }else{
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $query = "SELECT * FROM menu WHERE menu_id = $id";
            $hasil = $pdo->prepare($query);
            $hasil->execute();
            $row = $hasil->fetch();
            if (strcmp($nama, $row['makanan_name']) == 0) {
                $kategori = $_POST['kategori'];
                $harga = $_POST['harga'];
                $desc = $_POST['desc'];
                $id = $_POST['id'];
                $sql = "UPDATE menu
                SET categories_id = :cat,
                menu_harga = :harga,
                menu_deskripsi = :deskripsi
                WHERE menu_id = $id
                ";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':cat', $kategori);
                $stmt->bindParam(':harga', $harga);
                $stmt->bindParam(':deskripsi', $desc);
                $stmt->execute();
                echo "<script>alert('Berhasil Mengubah Menu')</script>";
                echo "<script>window.location.href = '../views/menu.php';</script>";
            }
            else{
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                $query = "SELECT * FROM menu WHERE menu_id = $id";
                $hasil = $pdo->prepare($query);
                $hasil->execute();
                $row = $hasil->fetch();
                $bener = $row["menu_gambar"];
                $format = substr($bener, -4); // returns "s"
                $gabung = $nama . $format;
                rename('../'.$bener.'', "../gambar/$gabung");
                
                $gambar = "gambar/$gabung";
                $kategori = $_POST['kategori'];
                $harga = $_POST['harga'];
                $desc = $_POST['desc'];
                $sql = "UPDATE menu
                SET makanan_name = :nama,
                menu_gambar = :gambar,
                categories_id = :cat,
                menu_harga = :harga,
                menu_deskripsi = :deskripsi
                WHERE menu_id = $id
                ";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nama', $nama);
                $stmt->bindParam(':gambar', $gambar);
                $stmt->bindParam(':cat', $kategori);
                $stmt->bindParam(':harga', $harga);
                $stmt->bindParam(':deskripsi', $desc);
                $stmt->execute();
                echo "<script>alert('Berhasil Mengubah Menu')</script>";
                echo "<script> window.location.href = '../views/menu.php';</script>";
                }
            }    
        }


        }elseif($_GET['action'] == "delete"){
            $query = "SELECT * FROM menu WHERE menu_id = ?";
            $hasil = $pdo->prepare($query);
            $hasil->execute([$_GET['id']]);
            $row = $hasil->fetch();
            $gambar = $row['menu_gambar'];
            if ($gambar == NULL) {
                $sql = "DELETE FROM menu
                    WHERE menu_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_GET['id']]);
                echo "<script>alert('Berhasil Menghapus Menu')</script>";
                echo "<script> window.location.href = '../views/menu.php';</script>";
            }else{
                unlink('../'.$gambar.'');
                $sql = "DELETE FROM menu
                    WHERE menu_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_GET['id']]);
                echo "<script>alert('Berhasil Menghapus Menu')</script>";
                echo "<script> window.location.href = '../views/menu.php';</script>";    
            }
            
            
        }
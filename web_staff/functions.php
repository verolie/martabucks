<?php

function koneksiDB(){
    try {
        $dsn = "mysql:host=localhost;dbname=project_website";
        $pdo = new PDO($dsn, 'root', '');
        return $pdo;
    }catch(PDOException $e){
        return $e;
    }
}

// checkFile($_FILES['foto'], $ext_boleh, 2*1024*1024)
function checkFile($file, Array $ext_boleh, $max_size = 0){
    $ext = getFileExt($file);

    if(in_array($ext, $ext_boleh) && ($file['size'] <= $max_size || $max_size == 0))
        return true;
    else
        return false;
}

function getFileExt($file){
    $ext = explode(".", $file['name']);
    $ext = end($ext);
    $ext = strtolower($ext);

    return $ext;
}
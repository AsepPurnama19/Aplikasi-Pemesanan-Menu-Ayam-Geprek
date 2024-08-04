<?php

include '../../../koneksi.php';

if ($_GET['act'] == 'tambah') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];

        $gambar = $_FILES['gambar']['name']; 
        $temp_file = $_FILES['gambar']['tmp_name'];
        $upload_dir = "../../../produk/";

        move_uploaded_file($temp_file, $upload_dir . $gambar);


        $id_kategori = $_POST['id_kategori'];
        
        if (isset($_POST["id_bahan"]) && is_array($_POST["id_bahan"])) {
            $selectedBahan = $_POST["id_bahan"];
        }else {
            $selectedBahan = isset($_POST["id_bahan"]) ? [$_POST["id_bahan"]] : [];
        }

    $insertMenuQuery = "INSERT INTO TbMenu (nama, harga, gambar, deskripsi, id_kategori) VALUES ('$nama', $harga, '$gambar','$deskripsi', '$id_kategori')";

    if ($con->query($insertMenuQuery) === TRUE) {
        $lastInsertedMenuId = $con->insert_id;

        foreach ($selectedBahan as $bahanId) {
            $insertStockQuery = "INSERT INTO tbmenustock (id_menu, id_bahan) VALUES ($lastInsertedMenuId, $bahanId)";
            $con->query($insertStockQuery);
        }

        header("Location: ../menu?pesantambah");
    } else {
        echo "Error: " . $insertMenuQuery . "<br>" . $con->error;
    }

    }
}

if ($_GET['act'] == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_menu = $_POST['id_menu'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $id_kategori = $_POST['id_kategori'];

        if ($_FILES['gambar']['size'] > 0) {
            $gambar = $_FILES['gambar']['name'];
            $temp_file = $_FILES['gambar']['tmp_name'];
            move_uploaded_file($temp_file, "../../../produk/" . $gambar);
        } else {
            $result = mysqli_query($con, "SELECT gambar FROM tbmenu WHERE id_menu = '$id_menu'");
            $row = mysqli_fetch_assoc($result);
            $gambar = $row['gambar'];
        }

        mysqli_query($con, "UPDATE tbmenu SET nama = '$nama', harga = '$harga', gambar = '$gambar', deskripsi = '$deskripsi', id_kategori = '$id_kategori' WHERE id_menu = '$id_menu'");

        mysqli_query($con, "DELETE FROM tbmenustock WHERE id_menu = '$id_menu'");
        foreach ($_POST['id_bahan'] as $id_bahan) {
            mysqli_query($con, "INSERT INTO tbmenustock (id_menu, id_bahan) VALUES ('$id_menu', '$id_bahan')");
        }

        header("location:../menu?pesanedit");
    }
}

if ($_GET['act'] == 'hapus') {
    $id_menu = $_GET['id'];

    $result = mysqli_query($con, "SELECT gambar FROM tbmenu WHERE id_menu ='$id_menu'");
    $row = mysqli_fetch_assoc($result);
    $gambar = $row['gambar'];

    mysqli_query($con, "DELETE FROM tbmenustock WHERE id_menu = '$id_menu'");
    
    mysqli_query($con, "DELETE FROM tbmenu WHERE id_menu = '$id_menu'");

    $file_path = "../../../produk/$gambar";
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    header("location:../menu?pesanhapus");
}
<?php

include '../../../koneksi.php';

#Proses Tambah
if ($_GET['act'] == 'tambah') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];

        mysqli_query($con,"INSERT INTO tbkategori (nama) VALUES('$nama')");

        header("location:../kategori?pesantambah");
    }
}

#Proses Edit
if ($_GET['act'] == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_kategori = $_POST['id_kategori'];
        $nama = $_POST['nama'];

        $result = mysqli_query($con, "UPDATE tbkategori SET nama = '$nama' WHERE id_kategori = '$id_kategori'");

        header("location:../kategori?pesanedit");
    }
}

#Proses Hapus
if ($_GET['act'] == 'hapus') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_kategori = $_GET['id'];

        $result = mysqli_query($con, "DELETE FROM tbkategori WHERE id_kategori = '$id_kategori'");

        header("location:../kategori?pesanhapus");
    }
}
<?php

include '../../../koneksi.php';

#Proses Tambah
if ($_GET['act'] == 'tambah') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $no_meja = $_POST['no_meja'];

        mysqli_query($con,"INSERT INTO tbmeja (no_meja) VALUES('$no_meja')");

        header("location:../meja?pesantambah");
    }
}

#Proses Edit
if ($_GET['act'] == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_meja = $_POST['id_meja'];
        $no_meja = $_POST['no_meja'];

        $result = mysqli_query($con, "UPDATE tbmeja SET no_meja = '$no_meja' WHERE id_meja = '$id_meja'");

        header("location:../meja?pesanedit");
    }
}

#Proses Hapus
if ($_GET['act'] == 'hapus') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_meja = $_GET['id'];

        $result = mysqli_query($con, "DELETE FROM tbmeja WHERE id_meja = '$id_meja'");

        header("location:../meja?pesanhapus");
    }
}
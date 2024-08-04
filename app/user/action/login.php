<?php
include '../../../koneksi.php';
session_start();

    $id_meja = $_POST['id_meja'];
    $nama = $_POST['nama'];

    $sql = "SELECT * FROM tbmeja WHERE id_meja='$id_meja'";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        if($row['status'] === 'Kosong'){
            $_SESSION['id_meja'] = $row['id_meja'];
            $_SESSION['nama'] = $nama;
            mysqli_query($con,"UPDATE tbmeja SET status = 'Terisi' WHERE id_meja = '$id_meja'");
            header("Location: ../menu");
            exit();
        }else{
            header("Location: ../user?pesanterisi");
            exit();
        }
    }else {
        header("Location: ../user?pesansalah");
    }


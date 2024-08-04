<?php

include '../../../koneksi.php';

$stock = [];

if ($_GET['act'] == 'tambah') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];
        $jumlah = (int)$_POST['jumlah'];

        $query = mysqli_query($con, "SELECT * FROM tbbahan");
        while ($row = mysqli_fetch_assoc($query)) {
            $stock[$row['nama']] = $row['jumlah'];
        }

        if(array_key_exists($nama, $stock)) {
            $stock[$nama] += $jumlah;
            $result = mysqli_query($con, "UPDATE tbbahan SET jumlah = $stock[$nama] WHERE nama = '$nama'");
        }else {
            $stock[$nama] = $jumlah;
            $result = mysqli_query($con,"INSERT INTO tbbahan (nama, jumlah) VALUES('$nama','$jumlah')");
        }

        

        if ($result){
            header("location:../bahan?pesantambah");
        }
        
    }
}
<?php 
include '../../../koneksi.php';

if ($_GET['act'] == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_pesan = $_POST['id_pesan'];

        $resultPesan = mysqli_query($con, "UPDATE tbpesan SET status = 'Selesai' WHERE id_pesan = '$id_pesan'");

        $id_meja_query = mysqli_query($con, "SELECT id_meja FROM tbpesan WHERE id_pesan = '$id_pesan'");
        $id_meja_data = mysqli_fetch_assoc($id_meja_query);
        $id_meja = $id_meja_data['id_meja'];

        $resultMeja = mysqli_query($con, "UPDATE tbmeja SET status = 'Kosong' WHERE id_meja = '$id_meja'");

        if($resultPesan && $resultMeja){
            header("location:../pemesanan?pesanedit");
        }else{
            echo "Gagal Update Data";
        }
    }
}

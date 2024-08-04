<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM tbuser WHERE username='$username' AND password='$password' ";
$qry = mysqli_query($con, $sql);

if($qry){

	$data = mysqli_fetch_array($qry);
	if($data['level']=="Owner"){
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['nama'] = $data['nama'];
		header("location:owner");

	}else if($data['level']=="Pelayan"){
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['nama'] = $data['nama'];
		header("location:pelayan");

	}else{
		header("location:index.php?pesan=gagal");
	}
}else{
	header("location:index.php?pesan=gagal");
}

?>

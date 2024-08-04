<?php
session_start();
if (isset($_POST['add_to_cart'])){
    $id_menu = $_GET['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
	$quantity = $_POST['quantity'];

	include '../../../koneksi.php';

	$sql = "SELECT M.id_menu, M.nama, M.harga, B.jumlah AS stok
	FROM tbmenustock MS
	INNER JOIN tbmenu M ON MS.id_menu = M.id_menu
	INNER JOIN tbbahan B ON MS.id_bahan = B.id_bahan
	WHERE M.id_menu = $id_menu";
	$result = mysqli_query($con, $sql);

	if ($result) {
	$row = mysqli_fetch_assoc($result);
	$stok = $row['stok'];

	if ($quantity > $stok) {
		header("Location: ../menu.php?pesanstock=Kosong");
		exit();
	}

    $_SESSION['keranjang'][$id_menu] = [
        'id_menu' => $_GET['id'],
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'quantity' => $_POST['quantity'],
    ];
	
}
}


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["keranjang"] as $keys => $values)
		{
			if($values["id_menu"] == $_GET["id"])
			{
				unset($_SESSION["keranjang"][$keys]);
			}
		}
	}
}
header('Location: '. $_SERVER['HTTP_REFERER']);
exit();
?>
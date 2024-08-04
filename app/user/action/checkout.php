<?php
session_start();
include '../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION['id_meja'])) {
        $id_meja = $_SESSION['id_meja'];
        $nama = $_SESSION['nama'];
    }

    // Assuming you have a session variable named 'keranjang' storing the cart items
    if (!empty($_SESSION['keranjang'])) {
        $tgl_pesan = date("Y-m-d H:i:s"); // Get current date and time

        // Loop through each item in the cart and check if the stock is sufficient
        $insufficientStock = false;
        foreach ($_SESSION['keranjang'] as $item) {
            $id_menu = $item["id_menu"];
            $jumlah = $item["quantity"];

            // Check if the stock is sufficient for the selected quantity
            $sqlCheckStock = "SELECT jumlah FROM tbbahan B
                              INNER JOIN tbmenustock MS ON B.id_bahan = MS.id_bahan
                              WHERE MS.id_menu = '$id_menu'";
            $resultStock = mysqli_query($con, $sqlCheckStock);
            $rowStock = mysqli_fetch_assoc($resultStock);

            if ($rowStock['jumlah'] < $jumlah) {
                $insufficientStock = true;
                break; // Exit the loop if insufficient stock is found
            }
        }

        if (!$insufficientStock) {
            // Insert order details into the 'TbPesan' table
            $sqlInsertOrder = "INSERT INTO tbpesan (id_meja, nama, tgl_pesan, status)
                               VALUES ('$id_meja', '$nama', '$tgl_pesan', 'Proses')";
            mysqli_query($con, $sqlInsertOrder);

            // Get the generated id_pesan
            $id_pesan = mysqli_insert_id($con);

            $_SESSION['id_pesan'] = $id_pesan;

            // Loop through each item in the cart and insert into the 'TbPesanMenu' table
            foreach ($_SESSION['keranjang'] as $item) {
                $id_menu = $item["id_menu"];
                $jumlah = $item["quantity"];
                $total_harga = $item["quantity"] * $item["harga"];

                // Insert item details into the 'TbPesanMenu' table
                $sqlInsertDetail = "INSERT INTO TbPesanMenu (id_pesan, id_menu, jumlah, total_harga)
                                    VALUES ('$id_pesan', '$id_menu', '$jumlah', '$total_harga')";
                mysqli_query($con, $sqlInsertDetail);

                // Update the stock in the 'tbbahan' table
                $sqlUpdateBahan = "UPDATE tbbahan B
                                    INNER JOIN tbmenustock MS ON B.id_bahan = MS.id_bahan
                                    SET B.jumlah = B.jumlah - $jumlah
                                    WHERE MS.id_menu = '$id_menu'";
                mysqli_query($con, $sqlUpdateBahan);
            }

            // Clear the cart after successful checkout
            unset($_SESSION['keranjang']);
            header("Location: ../nota"); // Redirect to menu page after checkout
            exit();
        } else {
            // jika stock kurang
            header("Location: ../menu?pesanstock");
        }
    } else {
        // Handle the case where the cart is empty
        header("Location: ../menu?pesankosong");
    }
} else {
    // Handle invalid form submission
    echo "Invalid form submission.";
}
?>
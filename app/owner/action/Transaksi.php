<?php
include '../../../koneksi.php';
$bulan = $_POST['bulan'];

// menu
$queryMenu = "SELECT pm.id_pesanmenu, m.nama, SUM(pm.jumlah) AS jumlah_terjual, p.tgl_pesan
              FROM tbpesanmenu pm
              JOIN tbmenu m ON pm.id_menu = m.id_menu
              JOIN tbpesan p ON pm.id_pesan = p.id_pesan
              GROUP BY pm.id_menu, m.nama";
$hasilMenu = mysqli_query($con, $queryMenu);
$jumlah_data_menu = mysqli_num_rows($hasilMenu);

// pengunjung
$queryTotalPengunjung = "SELECT COUNT(*) AS total_pengunjung, tgl_pesan
                        FROM tbpesan";
$hasilTotalPengunjung = mysqli_query($con, $queryTotalPengunjung);
$jumlah_data_pengunjung = mysqli_num_rows($hasilTotalPengunjung);

// pendapatan
$queryTotalPendapatan = "SELECT SUM(total_harga) AS total_pendapatan, p.tgl_pesan
                        FROM tbpesanmenu pm
                        JOIN tbpesan p ON pm.id_pesan = p.id_pesan";
$hasilTotalPendapatan = mysqli_query($con, $queryTotalPendapatan);
$jumlah_data_pendapatan = mysqli_num_rows($hasilTotalPendapatan);

// Tanggal Cetak
$tanggalCetak = date('Y-m-d');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan Asoka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 30px;
        }

        .footer {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Bulanan Asoka</h1>
        <p>Bulan: <?php echo date("F Y", strtotime($bulan)); ?></p>
    </div>

    <div class="content">
        <h2>Penjualan Menu:</h2>
        <ul>
            <?php
            if ($jumlah_data_menu > 0) {
                $i = 1;
            while ($row = mysqli_fetch_assoc($hasilMenu)) {
                if (date("Y-m", strtotime($row['tgl_pesan'])) == $bulan) {
                echo "<li>{$row['nama']}: {$row['jumlah_terjual']}</li>";
            }
        }
    }
            ?>
        </ul>

        <h2>Jumlah Pengunjung:</h2>
        <p>Total Pengunjung: <?php
            if ($jumlah_data_pengunjung > 0) {
                $i = 1;
            while ($row = mysqli_fetch_assoc($hasilTotalPengunjung)) {
                if (date("Y-m", strtotime($row['tgl_pesan'])) == $bulan) {
                echo "{$row['total_pengunjung']}";
            }
        }
    }
            ?></p>

        <h2>Total Pendapatan:</h2>
        <p>Total Pendapatan: <?php
            if ($jumlah_data_pendapatan > 0) {
                $i = 1;
            while ($row = mysqli_fetch_assoc($hasilTotalPendapatan)) {
                if (date("Y-m", strtotime($row['tgl_pesan'])) == $bulan) {
                    $totalPendapatan = number_format($row['total_pendapatan'],2,',',',');
                echo "Rp. {$totalPendapatan}";
            }
        }
    }
            ?></p>
    </div>

    <div class="footer">
        <p>Tanggal Cetak: <?php echo $tanggalCetak; ?></p>
    </div>

</body>
</html>

<script>
    window.print();
</script>
<?php
session_start();
include '../../koneksi.php';

// Pastikan ada sesi id_pesan yang valid
if (isset($_SESSION['id_pesan'])) {
    $id_pesan = $_SESSION['id_pesan'];

    // Query untuk mendapatkan informasi nota transaksi
    $sql = "SELECT P.id_pesan, P.tgl_pesan, P.status, M.no_meja
            FROM tbpesan P
            INNER JOIN tbmeja M ON P.id_meja = M.id_meja
            WHERE P.id_pesan = '$id_pesan'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en" >
 
<head>
 
  <meta charset="UTF-8">
  <title>Asoka</title>
 
  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 4mm;
  margin: 0 auto;
  width: 200mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: 1.5em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: 1.2em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .8em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 50mm;
}
#invoice-POS .itemtext {
  font-size: 1.1em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
 
    </style>
</head>
 
<body translate="no" >
 
 
  <div id="invoice-POS">
 
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>Ayam Geprek Asoka</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
 
    <div id="mid">
      <div class="info">
        <h2>Informasi Pemesanan</h2>
        <p> 
            Nama Pemesan :  <?php echo $_SESSION['nama']; ?></br>
            No Meja :  <?php echo $data['no_meja']; ?></br>
            Tanggal Pemesanan :  <?php echo $data['tgl_pesan']; ?></br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
 
    <div id="bot">
 
                    <div id="table">
                        <table>
                        <tr class="tabletitle">
                                <td class="item"><h2>Nama</h2></td>
                                <td class="Hours"><h2>Qty</h2></td>
                                <td class="Rate"><h2>Sub Total</h2></td>
                            </tr>
                        <?php
                          $sqlDetail = "SELECT MN.nama, PM.jumlah, MN.harga, PM.total_harga
                                        FROM tbpesanmenu PM
                                        INNER JOIN tbmenu MN ON PM.id_menu = MN.id_menu
                                        WHERE PM.id_pesan = '$id_pesan'";
                          $resultDetail = mysqli_query($con, $sqlDetail);
                          $totalOrder = 0;

                          if ($resultDetail && mysqli_num_rows($resultDetail) > 0) {
                              while ($dataDetail = mysqli_fetch_assoc($resultDetail)) {

                            ?>
 
                            <tr class="service">
                                <td class="tableitem"><p class="itemtext"><?php echo $dataDetail['nama']; ?></p></td>
                                <td class="tableitem"><p class="itemtext"><?php echo $dataDetail['jumlah']; ?></p></td>
                                <td class="tableitem"><p class="itemtext">Rp. <?php echo number_format($dataDetail["harga"], 2); ?></p></td>
                            </tr>

                            <?php 
                             $totalOrder += $dataDetail['total_harga'];
                              }
                            ?>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Total Harga</h2></td>
                                <td class="payment"><h2>Rp. <?php echo number_format($totalOrder, 2); ?></h2></td>
                            </tr>

                            <?php }}} ?>
 
                        </table>
                    </div><!--End Table-->
 
                    <div id="legalcopy">
                        <p class="legal"><strong>Silahkan lakukan pembayaran ke pelayan!</strong> Terima kasih sudah memesan makanan disini. Jangan lupa berkunjung kembali.
                        </p>
                    </div>
 
                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
 
</body>
 
</html>


<script>
    setTimeout(function(){
        window.location.href = 'user';
    }, 15000);
</script>

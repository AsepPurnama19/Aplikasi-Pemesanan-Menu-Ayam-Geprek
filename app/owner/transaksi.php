<?php
session_start();

if(!isset($_SESSION['id_user'])){ ?>
    <script>
        alert("!!!! Maaf Anda Harus Login Dulu.")
        window.location.assign('admin');
    </script>
    <?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Asoka</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Asoka</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#kelola-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Kelola</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kelola-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="meja">
              <i class="bi bi-circle"></i><span>Meja</span>
            </a>
          </li>
          <li>
            <a href="bahan">
              <i class="bi bi-circle"></i><span>Bahan</span>
            </a>
          </li>
          <li>
            <a href="kategori">
              <i class="bi bi-circle"></i><span>Kategori</span>
            </a>
          </li>
          <li>
            <a href="menu">
              <i class="bi bi-circle"></i><span>Menu</span>
            </a>
          </li>
        </ul>
      </li><!-- End Kelola Nav -->

      <li class="nav-item">
        <a class="nav-link" href="transaksi">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Data Transaksi</span>
        </a>
      </li><!-- End Data Transaksi Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-left"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Logout Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Transaksi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Transaksi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Data Transaksi</h5>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cetak">
                Cetak Laporan
              </button>
              </div> 
              <div class="modal fade" id="cetak" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Cetak Laporan Transaksi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p>Masukkan Periode Laporan Yang Ingin dicetak</p>
                    <form action="action/Transaksi.php" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Bulan</label>
                                    <input type="month" class="form-control" name="bulan" required>
                                </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Tambah Modal-->

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Meja</th>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Tanggal Pesan</th>
                    <th scope="col">Detail Pesanan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                include '../../koneksi.php';
                $sql = "SELECT MJ.no_meja, P.nama, P.tgl_pesan, P.status, P.id_pesan
                        FROM tbpesan P
                        INNER JOIN tbmeja MJ ON P.id_meja = MJ.id_meja
                        WHERE P.status = 'Selesai'
                        ORDER BY P.tgl_pesan DESC";
                $query = mysqli_query($con, $sql);
                $jumlah_data = mysqli_num_rows($query);

                if ($jumlah_data > 0){
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <th><?php echo $i?></th>
                        <td><?php echo $data['no_meja']?></td>
                        <td><?php echo $data['nama']?></td>
                        <td><?php echo $data['tgl_pesan']?></td>
                        <td>
                            <!-- Query untuk mendapatkan detail pesanan -->
                            <?php
                            $total = 0;
                            $id_pesan = $data['id_pesan'];
                            $detail_sql = "SELECT MN.nama, PM.jumlah, PM.total_harga
                                            FROM tbpesanmenu PM
                                            INNER JOIN tbmenu MN ON PM.id_menu = MN.id_menu
                                            WHERE PM.id_pesan = $id_pesan";
                            $detail_query = mysqli_query($con, $detail_sql);
                            ?>  
                            <h5 class="mt-3">Menu</h5>
                            <ul>
                                <?php while ($detail_data = mysqli_fetch_array($detail_query)) {
                                    echo "<li>{$detail_data['nama']} | Jumlah: <b>{$detail_data['jumlah']}</b></li>";
                                    $total += $detail_data["total_harga"];
                                }
                                ?>
                            </ul>
                            <p><strong>Total Harga:</strong> Rp. <?php echo number_format($total, 2); ?></p>
                        </td>
                    </tr>
                    <?php $i++; }}
                ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Asoka AA</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>
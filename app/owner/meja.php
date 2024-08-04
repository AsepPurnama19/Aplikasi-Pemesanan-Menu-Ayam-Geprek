<?php
session_start();

if(!isset($_SESSION['id_user'])){ ?>
    <script>
        alert("!!!! Maaf Anda Harus Login Dulu.")
        window.location.assign('../');
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
        <a class="nav-link " data-bs-target="#kelola-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Kelola</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kelola-nav" class="nav-content show " data-bs-parent="#sidebar-nav">
          <li>
            <a href="meja" class="active">
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
        <a class="nav-link collapsed" href="transaksi">
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
      <h1>Kelola Meja</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Meja</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Data Meja</h5>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Meja
              </button>
            </div>
              <div class="modal fade" id="tambah" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Meja</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="action/Meja.php?act=tambah" method="post" role="form">
                                <div class="mb-3">
                                    <label class="form-label">No Meja</label>
                                    <input type="text" class="form-control" name="no_meja" required>
                                </div> 
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Tambah Modal-->

              <?php if(isset($_GET['pesantambah'])){ ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Tambah Meja Berhasil 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>

              <?php if(isset($_GET['pesanedit'])){ ?>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-1"></i>
                Edit Meja Berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>

              <?php if(isset($_GET['pesanhapus'])){ ?>
              <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i>
                Hapus Meja Berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Meja</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                         include '../../koneksi.php';
                         $sql   = "SELECT * FROM tbmeja ORDER BY no_meja ASC"; 
                         $query = mysqli_query($con, $sql); 
                         $jumlah_data = mysqli_num_rows($query);
                        if ($jumlah_data > 0){
                            $i=1;
                            while ($data = mysqli_fetch_array($query)){
                        ?>
                  <tr>
                    <th><?php echo $i?></th>
                    <td><?php echo $data['no_meja']?></td>
                    <td><?php 
                          if ($data['status'] == 'Terisi'){
                            echo '<h5><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Terisi</span></h5>';
                          }else {
                            echo '<h5><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Kosong</span></h5>';
                          }
                        ?>
                    </td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_meja']; ?>">Ubah</button>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?php echo $data['id_meja']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Meja</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Edit -->
                                    <form action="action/Meja.php?act=edit&id=<?php echo $data['id_meja']; ?>" method="post" role="form">
                                    <input type="hidden" name="id_meja" value="<?php echo $data['id_meja']?>">
                                        <div class="mb-3">
                                            <label class="form-label">No Meja</label>
                                            <input type="text" class="form-control" name="no_meja" value="<?php echo $data['no_meja']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </form>
                                    <!-- End Form Edit -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['id_meja']; ?>">Hapus</button>
                    <!-- Modal Hapus -->
                    <div class="modal fade" id="hapusModal<?php echo $data['id_meja']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Meja</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus no meja <b>"<?php echo $data['no_meja']; ?>"</b>?</p>
                                    <!-- Form Hapus -->
                                    <form action="action/Meja.php?act=hapus&id=<?php echo $data['id_meja']; ?>" method="post" role="form">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <!-- End Form Hapus -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Hapus -->
                    </td>
                  </tr>
                  <?php $i++; } }?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

              <div class="modal fade" id="edit<?php echo $data['id_meja']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Meja</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="action/Meja.php?act=edit" method="post" role="form">
                                <div class="mb-3">
                                    <label class="form-label">No Meja</label>
                                    <input type="text" class="form-control" name="no_meja" value="<?php echo $data['no_meja']; ?>">
                                </div> 
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Tambah Modal-->

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
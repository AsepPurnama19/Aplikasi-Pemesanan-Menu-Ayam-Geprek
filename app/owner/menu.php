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
        <a class="nav-link " data-bs-target="#kelola-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Kelola</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kelola-nav" class="nav-content show " data-bs-parent="#sidebar-nav">
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
            <a href="menu" class="active">
              <i class="bi bi-circle"></i><span>Menu</span>
            </a>
          </li>
        </ul>
      </li><!-- End Kelola Nav -->

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
      <h1>Kelola Menu</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Menu</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Data Menu</h5>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Menu
              </button>
            </div>
              <div class="modal fade" id="tambah" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Menu</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="action/Menu.php?act=tambah" method="post" role="form" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Harga</label>
                                    <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                    <input type="number" class="form-control" name="harga" required>
                                </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" class="form-control" name="gambar" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" class="form-select" required>
                                    <option selected>----- Pilih Kategori -----</option>
                                        <?php
                                        include '../../koneksi.php';
                                        $sql = "SELECT * FROM tbkategori";
                                        $result = mysqli_query($con, $sql);

                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo "<option value='{$row['id_kategori']}'>{$row['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Stock</label>
                                    <select name="id_bahan[]" class="form-select" multiple required>
                                    <option selected>----- Pilih Bahan -----</option>
                                        <?php
                                        include '../../koneksi.php';
                                        $sql = "SELECT * FROM tbbahan";
                                        $result = mysqli_query($con, $sql);

                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo "<option value='{$row['id_bahan']}'>{$row['nama']}</option>";
                                        }
                                        ?>
                                    </select>
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
                Tambah Menu Berhasil 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>

              <?php if(isset($_GET['pesanedit'])){ ?>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-1"></i>
                Edit Menu Berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>

              <?php if(isset($_GET['pesanhapus'])){ ?>
              <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i>
                Hapus Menu Berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                         include '../../koneksi.php';
                         $sql   = "SELECT M.id_menu,M.nama,M.harga,M.deskripsi,M.gambar,K.nama as kategori, B.jumlah  
                                 FROM tbmenustock MS
                                 INNER JOIN tbmenu M ON MS.id_menu = M.id_menu
                                 INNER JOIN tbbahan B ON MS.id_bahan = B.id_bahan
                                 INNER JOIN tbkategori K ON M.id_kategori = K.id_kategori
                                 GROUP BY M.id_menu
                                 ORDER BY B.jumlah DESC"; 
                         $query = mysqli_query($con, $sql); 
                         $jumlah_data = mysqli_num_rows($query);
                        if ($jumlah_data > 0){
                            $i=1;
                            while ($data = mysqli_fetch_array($query)){
                        ?>
                  <tr>
                    <th><?php echo $i?></th>
                    <td><?php echo $data['nama']?></td>
                    <td>Rp. <?php echo $data['harga']?></td>
                    <td><?php echo "<img src='../../produk/$data[gambar]' width='100' height='90'/>";?></td>
                    <td><?php echo $data['deskripsi']?></td>
                    <td><?php echo $data['kategori']?></td>
                    <td><?php echo $data['jumlah']?></td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_menu']; ?>">Ubah</button>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?php echo $data['id_menu']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Edit -->
                                    <form action="action/Menu.php?act=edit&id=<?php echo $data['id_menu']; ?>" method="post" role="form">
                                    <input type="hidden" name="id_menu" value="<?php echo $data['id_menu']?>">
                                    <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']?>" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Harga</label>
                                    <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                    <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']?>" required>
                                </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Gambar <small class="text-muted">  Biarkan kosong jika tidak ingin mengganti gambar.</small></label>
                                    <input type="file" class="form-control" name="gambar">
                                    
                                    <img src="../../produk/<?php echo $data['gambar']; ?>" alt="Current Image" class="mt-2" style="width: 100px; height: 90px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" value="<?php echo $data['deskripsi']?>" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" class="form-select"  required>
                                    <option selected>----- Pilih Kategori -----</option>
                                    <?php
                                        include '../../koneksi.php';
                                        $sql = "SELECT * FROM tbkategori";
                                        $result = mysqli_query($con, $sql);

                                        while ($row_kategori = mysqli_fetch_assoc($result)){
                                          $selected_kategori = ($row_kategori['id_kategori'] == $data['id_kategori']) ? 'selected' : '';
                                            echo "<option value='{$row_kategori['id_kategori']}' {$selected_kategori}>{$row_kategori['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Stock</label>
                                    <select name="id_bahan[]" class="form-select" multiple required>
                                        <?php
                                        include '../../koneksi.php';
                                        $sql = "SELECT * FROM tbbahan";
                                        $result = mysqli_query($con, $sql);

                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo "<option value='{$row['id_bahan']}' $selected>{$row['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                                  </form>
                                    <!-- End Form Edit -->
                                </div>
                            </div>
                        </div>
                    <!-- End Modal Edit -->

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['id_menu']; ?>">Hapus</button>
                      <!-- Modal Hapus -->
                    <div class="modal fade" id="hapusModal<?php echo $data['id_menu']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus menu <b>"<?php echo $data['nama']; ?>"</b>?</p>
                                    <!-- Form Hapus -->
                                    <form action="action/Menu.php?act=hapus&id=<?php echo $data['id_menu']; ?>" method="post" role="form">
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
              </div>
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
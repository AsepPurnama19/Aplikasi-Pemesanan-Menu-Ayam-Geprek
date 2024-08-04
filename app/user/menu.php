<?php
session_start();

if(!isset($_SESSION['id_meja'])){ ?>
    <script>
        alert("!!!! Maaf Anda Harus Login Dulu.")
        window.location.assign('index.php');
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
      <a href="menu" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Asoka</span>
      </a>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="get" action="menu">
        <input type="text" name="cari" placeholder="Search" title="Enter search keyword">
        <button type="submit" value="cari"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

     <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

          <a class="nav-link nav-icon" data-bs-toggle="modal" data-bs-target="#keranjang">
            <i class="bi bi-cart"></i>
            <span class="badge bg-primary badge-number">
              <?php 
              $cartItem = isset($_SESSION['keranjang']) ? count($_SESSION['keranjang']) : 0;
              echo $cartItem;
              ?>
            </span>
          </a>

    <a class="nav-link nav-profile d-flex align-items-center pe-0">
            <span class="d-none d-md-block ps-2">Selamat Datang</span>
          </a><!-- End Selamat Datang -->

  </header><!-- End Header -->

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
              <!-- Alert -->
                <?php if(isset($_GET['pesanstock']) && $_GET['pesanstock'] == 'Kosong'){ ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-1"></i>
                    Stock Kurang 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php } ?>
                  <?php if(isset($_GET['pesankosong'])){ ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-1"></i>
                    Keranjang Kosong
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php } ?>
              <?php 
                  include '../../koneksi.php';
                  if(isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $namaKategori = "";
                    $sql = "SELECT M.id_menu,M.nama,M.harga,M.gambar,M.deskripsi,K.nama as kategori, B.jumlah  
                            FROM tbmenustock MS
                            INNER JOIN tbmenu M ON MS.id_menu = M.id_menu
                            INNER JOIN tbbahan B ON MS.id_bahan = B.id_bahan
                            INNER JOIN tbkategori K ON M.id_kategori = K.id_kategori
                            WHERE M.nama like '%".$cari."%'
                            GROUP BY M.id_menu
                            ORDER BY K.nama, B.jumlah DESC";
                            
                  }else{
                    $namaKategori = "";
                    $sql = "SELECT M.id_menu,M.nama,M.harga,M.gambar,M.deskripsi,K.nama as kategori, B.jumlah  
                            FROM tbmenustock MS
                            INNER JOIN tbmenu M ON MS.id_menu = M.id_menu
                            INNER JOIN tbbahan B ON MS.id_bahan = B.id_bahan
                            INNER JOIN tbkategori K ON M.id_kategori = K.id_kategori
                            GROUP BY M.id_menu
                            ORDER BY K.nama, B.jumlah DESC";
                  }
                          $query = mysqli_query($con, $sql); 
                          $jumlah_data = mysqli_num_rows($query);
                         if ($jumlah_data > 0){
                             $i=1;
                             while ($data = mysqli_fetch_array($query)){
                              if($data['jumlah'] > 0){
                                if($data['kategori'] != $namaKategori) {
                                  if ($namaKategori != "") {
                                    echo "</div>";
                                  }
                                  echo "<h2 class='text-center'>{$data['kategori']}</h2>";
                                  echo "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
                                  $namaKategori = $data['kategori'];
                              }
                         ?>

                    
                    <div class="col md-3 col-sm-6 mt-2">
                      <form method="post" action="action/keranjang.php?action=add&id=<?php echo $data["id_menu"]; ?>">
                        <div class="card">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo "../../produk/$data[gambar]";?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h4 class="card-title"><b><?php echo $data['nama']?></b></h4>
                                    <p class="card-text"><?php echo $data['deskripsi']?></p>
                                    <input type="hidden" name="nama" value="<?php echo $data["nama"]; ?>" />
                                    <!-- Product price-->
                                    <p class="card-text">Rp. <?php echo number_format($data["harga"], 2); ?></p>
                                    <input type="hidden" name="harga" value="<?php echo $data["harga"]; ?>" />
                                    <p class="card-text">Stock : <?php echo $data['jumlah']?></p>
                                    <input type="text" name="quantity" value="1" class="form-control" />
                                    <input type="submit" name="add_to_cart" class="btn btn-block btn-primary" value="Add to Cart" />
                            </form>
                                </div>
                            </div>
                              
                        </div>
                    </div>
                    <?php $i++; }} } ?>

              <div class="modal fade" id="keranjang" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Keranjang</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="table-responsive">
                        <form method="post" action="action/checkout.php">
                          <table class="table table-bordered">
                            <tr>
                              <th width="40%">Nama</th>
                              <th width="20%">Harga</th>
                              <th width="5%">Qty</th>
                              <th width="25%">Total</th>
                              <th width="5%">Action</th>
                            </tr>
                            <?php
                            $total = 0;
                            if(!empty($_SESSION['keranjang'])) {
                              foreach ($_SESSION['keranjang'] as $item){
                            ?>
                            <tr>
                              <td><?php echo $item["nama"]; ?></td>
                              <td>Rp. <?php echo number_format($item["harga"], 2); ?></td>
                              <td><?php echo $item["quantity"]; ?></td>
                              <td>Rp. <?php echo number_format($item["quantity"] * $item["harga"], 2);?></td>
                              <td><a href="action/keranjang.php?action=delete&id=<?php echo $item["id_menu"]; ?>"><span class="text-danger">Remove</span></a></td>
                            </tr>
                            <?php
                                $total = $total + ($item["quantity"] * $item["harga"]);
                              }
                            ?>
                            <tr>
                              <td colspan="3" align="right">Total Harga</td>
                              <td align="right">Rp. <?php echo number_format($total, 2); ?></td>
                              <td></td>
                            </tr>
                              <?php }  ?>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Checkout</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Keranjang Icon -->
                </div>
            </div>
        </section>

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

